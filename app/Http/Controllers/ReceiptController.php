<?php

namespace App\Http\Controllers;

use App\Models\Vip;
use App\Models\File;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Receipt;
use App\Models\Ministry;
use App\Models\Category;
use App\Models\Department;
use App\Models\Sendertype;
use App\Models\Subcategory;
use App\Models\Receiptshare;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\Deliverymode;
use App\Models\Communication;
use App\Models\ContactDetails;
use App\Models\Correspondence;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;
use App\DataTables\ReceiptDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\ReceiptinboxDataTable;
use App\DataTables\ReceiptshareDataTable;
use App\DataTables\ReceiptsearchDataTable;
use App\Models\Movement;
use thiagoalessio\TesseractOCR\TesseractOCR;


class ReceiptController extends Controller
{
    public function index(ReceiptDataTable $table)
    {
        // phpinfo();
        $vips = Vip::all();
        $categories = Category::all();
        // if (\Auth::user()->hasRole('admin')) {
        //     return view('receipt.index', compact('url', 'recei pts'));
        // } else {
        //     $url = 'receipt';
        //     return view('receipt.user.userIndex', compact('url', 'receipts'));
        // }
        $files = File::all();

        if (\Auth::user()->hasRole('admin')) {
            return $table->render('receipt.index');
        } else {
            $url = 'receipt';
            return $table->render('receipt.user.userIndex', compact('files', 'url', 'vips', 'categories'));
        }
    }

    

    public function showModal($id)
    {
        $user = User::find($id);

        if (!$user) {
            return "<p class='text-danger'>User not found.</p>";
        }

        return view('receipt.user.usermodal', compact('user'));
    }

    public function showModalSent($id)
    {
        $user = User::find($id);

        if (!$user) {
            return "<p class='text-danger'>User not found.</p>";
        }

        return view('receipt.user.usermodal', compact('user'));
    }


    public function put_in_file(Request $request)
    {
        $correspondence = [
            'file_id' => $request->file_id,
            'receipt_id' => $request->receipt_id,
            'createdBy' => \Auth::user()->id
        ];
        $result = Correspondence::create($correspondence);
        if ($result) {
            return response()->json([
                'code' => 200,
                'data' => $result->fresh()
            ]);
        }
    }

    public function receipt_convert($id)
    {
        $url = 'receipt';
        $id = Crypt::decrypt($id);
        $communication = Communication::all();
        $deliverymode = Deliverymode::all();
        $sendertype = Sendertype::all();
        $vip = Vip::all();
        $ministry = Ministry::all();
        $country = Country::all();
        $state = State::all();
        $category = Category::all();
        $subcategory = Subcategory::all();
        $receipt = Receipt::where('id', $id)->with(['subCategory', 'Category', 'communication', 'delivery', 'sender', 'Vip', 'ministry', 'Country', 'State'])->first();
        $receipt->communication = $receipt->communication->communication ?? 'N/A';
        $receipt->mode = $receipt->delivery->mode ?? 'N/A';
        $receipt->sender = $receipt->sender->sendertype ?? 'N/A';
        $receipt->vip = $receipt->Vip->name ?? 'N/A';
        // dd($receipt); 
        $filepath = public_path('receipt/upload') . '/' . $receipt->receipt_file;
        $filePath = asset('public/receipt/upload/' . $receipt->receipt_file);
        return view('receipt.user.convert', compact('url', 'receipt'));
    }

    public function convert_physical_receipt(Request $request)
    {
        $receipt =  Receipt::where('id', $request->id)->first();
        $receipt->receipt_status = "Electronic";
        $file = $request->file('upload_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = public_path('receipt/upload') . '/' . $filename;
        $file->move(public_path('receipt/upload'), $filename);
        $receipt->receipt_file = $filename;
        $outputText = '';
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);
        $text = $pdf->getText();
        if (trim($text)) {
            // PDF has embedded text
            $outputText = $text;
        } else {
            // PDF is image-based, convert to images and apply OCR
            $pageCount = 5; // adjust based on actual page count or dynamically detect
            for ($page = 1; $page <= $pageCount; $page++) {
                $imagePath = storage_path("app/temp_page_{$page}.png");

                // Convert page to image
                Browsershot::html(file_get_contents($filePath))
                    ->setOption('page', $page)
                    ->save($imagePath);

                // Run OCR
                $text = (new TesseractOCR($imagePath))->run();
                $outputText .= $text;
            }
        }
        $receipt->ocr_text = $outputText == '' ? null : $outputText;
        $receipt->save();
    }

    public function receipt_send_back(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'section_id' => 'required',
        ]);
        // dd($request->all());
        $userId = Auth::id();
        $result = Receiptshare::where('receipt_id', $request->input('receipt_id'))
            ->where('sender_id', $request->input('recever_id'))
            ->where('recever_id', $userId)
            ->where('department_id', $request->input('department_id'))
            ->where('section_id', $request->input('section_id'))
            ->update([
                'send_back' => 1
            ]);
        $receiptshare = new Receiptshare();
        $receiptshare->receipt_id = $request->input('receipt_id');
        $receiptshare->recever_id = $request->input('recever_id');
        $receiptshare->sender_id = $userId;
        $receiptshare->department_id = $request->input('department_id');
        $receiptshare->section_id = $request->input('section_id');
        $receiptshare->save();
        return redirect()->route('receipt.inbox');
    }

    public function get_sender_details(Request $request)
    {
        Log::info($request->senderId);
        $sender = User::where('id', $request->senderId)->with('departments', 'sections')->first();
        if (!empty($sender)) {
            return response()->json([
                'data' => $sender,
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'No data found',
                'code' => 500
            ]);
        }
    }
    public function create()
    {
        $communication = Communication::all();
        $deliverymode = Deliverymode::all();
        $sendertype = Sendertype::all();
        $vip = Vip::all();
        $ministry = Ministry::all();
        $country = Country::all();
        $state = State::all();
        $category = Category::all();
        $subcategory = Subcategory::all();
        return view('receipt.create', compact('letter_reference_no', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory'));
    }
    //to create receipt conditionally
    public function user_create(Request $request)
    {
        $type = $request->type;
        $communication = Communication::all();
        $deliverymode = Deliverymode::all();
        $sendertype = Sendertype::all();
        $vip = Vip::all();
        $ministry = Ministry::all();
        $country = Country::all();
        $state = State::all();
        $category = Category::all();
        $subcategory = Subcategory::all();
        $timestamp = now()->timestamp; // Current timestamp
        $randomNumber = rand(1000, 9999); // Random 4-digit number
        $letter_reference_no = "DAK-{$timestamp}-{$randomNumber}";
        $contact_details = ContactDetails::pluck('name', 'id');
        $url = 'receipt';
        $numbers = range(1000, 1010);
        $random_key = array_rand($numbers);
        $com_num = $numbers[$random_key];

        if ($type == "physical") {
            return view('receipt.user.createPhysical', compact('com_num', 'contact_details', 'url', 'letter_reference_no', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory', 'type'));
        } elseif ($type == "electronics") {
            return view('receipt.user.createElectronics', compact('com_num', 'contact_details', 'url', 'letter_reference_no', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory', 'type'));
        }
    }
    public function get_contact_names(Request $request)
    {
        if ($request->name != null) {
            $data = ContactDetails::where('name', 'like', '%' . $request->name . '%')->select('id', 'name', 'email')->get();
            return response()->json([
                'data' => $data->isEmpty() ? null : $data,
                'code' => 200
            ]);
        } else {
            return response()->json([
                'data' =>  null,
                'code' => 200
            ]);
        }
    }

    public function get_contact_by_phone(Request $request)
    {
        if ($request->phone != null) {
            $data = ContactDetails::where('phone_number', 'like', '%' . $request->phone . '%')->select('id', 'name', 'email', 'phone_number')->get();
            return response()->json([
                'data' => $data->isEmpty() ? null : $data,
                'code' => 200
            ]);
        } else {
            return response()->json([
                'data' =>  null,
                'code' => 200
            ]);
        }
    }

    public function check_phone_exists(Request $request)
    {
        if ($request->phone != null) {
            $exists = ContactDetails::where('phone_number', $request->phone)->exists();
            return response()->json([
                'exists' => $exists,
                'code' => 200
            ]);
        }
        return response()->json([
            'exists' => false,
            'code' => 200
        ]);
    }

    public function get_contact_details_by_id(Request $request)
    {
        $data = ContactDetails::where('id', $request->id)->first();
        return response()->json([
            'data' =>  $data,
            'code' => 200
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->has('saveContact')) {
            $contact_data = $request->only([
                'name',
                'ministry_department',
                'designation',
                'organitation',
                'email',
                'address',
                'pin_code',
                'phone_number',
                'country',
                'state',
                'city'
            ]);
            ContactDetails::updateOrCreate(
                ['name' => $request->name, 'email' => $request->email], // Matching criteria
                $contact_data // Data to update or create
            );
        }

        if ($request->receipt_status == "Electronic" && !$request->has('receipt_file')) {
            $this->validate($request, [
                'receipt_file' => 'required',
            ]);
        }

        $this->validate($request, [
            'form_of_communication' => 'required',
            'receved_date' => 'required',
            'delivery_mode' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'subject' => 'required',
        ]);

        $userId = Auth::user()->id;
        $receipt = new Receipt();
        $receipt->computer_number = $request->input('computer_number');
        $receipt->receipt_status = $request->input('receipt_status') ?? 'Physical';
        // dd($receipt->receipt_status);
        $receipt->dairy_date = $request->input('dairy_date');
        $receipt->form_of_communication = $request->input('form_of_communication');
        $receipt->language = $request->input('language');
        $receipt->receved_date = $request->input('receved_date');
        $receipt->letter_ref_no = $request->input('letter_ref_no');
        $receipt->letter_date = $request->input('letter_date');
        $receipt->delivery_mode = $request->input('delivery_mode');
        $receipt->mode_number = $request->input('mode_number');
        $receipt->sender_type = $request->input('sender_type');
        $receipt->vip = $request->input('vip');
        $receipt->name = $request->input('name');
        $receipt->ministry_department = $request->input('ministry_department');
        $receipt->designation = $request->input('designation');
        $receipt->organitation = $request->input('organitation');
        $receipt->email = $request->input('email');
        $receipt->address = $request->input('address');
        $receipt->pin_code = $request->input('pin_code');
        $receipt->phone_number = $request->input('phone_number');
        $receipt->country = $request->input('country');
        $receipt->state = $request->input('state');
        $receipt->city = $request->input('city');
        $receipt->category = $request->input('category');
        $receipt->subcategory = $request->input('subcategory');
        $receipt->subject = $request->input('subject');
        $receipt->remarks = $request->input('remarks');
        $receipt->createdBy = $userId;

        if ($request->hasFile('receipt_file')) {
            $file = $request->file('receipt_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Define upload path
            $uploadPath = public_path('assets/receipt/upload');
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Move the file
            $file->move($uploadPath, $filename);
            $receipt->receipt_file = $filename;

            // Handle OCR
            $filePath = $uploadPath . '/' . $filename;
            $outputText = '';
            
            if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) === 'pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
                
                if (trim($text)) {
                    // PDF has embedded text
                    $outputText = $text;
                } else {
                    // PDF is image-based, convert to images and apply OCR
                    $pageCount = 5; // adjust based on actual page count
                    for ($page = 1; $page <= $pageCount; $page++) {
                        $imagePath = storage_path("app/temp_page_{$page}.png");

                        // Convert page to image
                        Browsershot::html(file_get_contents($filePath))
                            ->setOption('page', $page)
                            ->save($imagePath);

                        // Run OCR
                        $text = (new TesseractOCR($imagePath))->run();
                        $outputText .= $text;

                        // Clean up temporary image
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }
                
                $receipt->ocr_text = $outputText == '' ? null : mb_convert_encoding($outputText, 'UTF-8', 'UTF-8');
            }
        }
        // dd($request->all());
        $receipt->save();
        $receipt_data = $receipt->fresh();
        if ($request->input('action') === 'generate&send') {
            return redirect()->route('receipt.share', $receipt_data->id);
        }
        // return redirect()->route('receipt.index');
        return redirect()->route('receipt.details.view', Crypt::encrypt($receipt->id));
    }
    public function edit(Receipt $receipt)
    {
        $communication = Communication::all();
        $deliverymode = Deliverymode::all();
        $sendertype = Sendertype::all();
        $vip = Vip::all();
        $ministry = Ministry::all();
        $country = Country::all();
        $state = State::all();
        $category = Category::all();
        $subcategory = Subcategory::all();
        $filePath = asset('public/assets/receipt/upload/' . $receipt->receipt_file);
        if (\Auth::user()->hasRole('admin')) {
            return view('receipt.edit', compact('receipt', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory'));
        } else {
            $url = 'receipt';
            // Convert to lowercase for case-insensitive comparison
            $status = strtolower($receipt->receipt_status);
            
            if ($status === 'physical') {
                return view('receipt.user.editphysical', compact('url', 'receipt', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory', 'filePath'));
            } 
            // Check for both spellings
            elseif ($status === 'electronic' || $status === 'electronics') {
                return view('receipt.user.edit', compact('url', 'receipt', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory', 'filePath'));
            }
            else {
                // Default to index with error
                return redirect()->route('receipt.index')
                    ->with('error', 'Invalid receipt status: ' . $receipt->receipt_status);
            }
        }
    }

    public function update(Request $request, Receipt $receipt)
    {
        $this->validate($request, [
            'form_of_communication' => 'required',
            'receved_date' => 'required',
            'delivery_mode' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'subject' => 'required',
        ]);

        $input = $request->except('receipt_file', 'ocr_text');

        // Clean OCR text input if it's coming from user edit
        if ($request->has('ocr_text')) {
            $receipt->ocr_text = mb_convert_encoding($request->input('ocr_text'), 'UTF-8', 'UTF-8');
        }

        // Handle file upload
        if ($request->hasFile('receipt_file')) {
            $file = $request->file('receipt_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Define upload path
            $uploadPath = public_path('assets/receipt/upload');
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Delete old file if exists
            if ($receipt->receipt_file) {
                $oldFilePath = $uploadPath . '/' . $receipt->receipt_file;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Move the new file
            $file->move($uploadPath, $filename);
            
            // Update receipt file name
            $receipt->receipt_file = $filename;

            // Handle OCR for new file
            $filePath = $uploadPath . '/' . $filename;
            $outputText = '';
            
            if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) === 'pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
                
                if (trim($text)) {
                    // PDF has embedded text
                    $outputText = $text;
                } else {
                    // PDF is image-based, convert to images and apply OCR
                    $pageCount = 5; // adjust based on actual page count
                    for ($page = 1; $page <= $pageCount; $page++) {
                        $imagePath = storage_path("app/temp_page_{$page}.png");

                        // Convert page to image
                        Browsershot::html(file_get_contents($filePath))
                            ->setOption('page', $page)
                            ->save($imagePath);

                        // Run OCR
                        $text = (new TesseractOCR($imagePath))->run();
                        $outputText .= $text;

                        // Clean up temporary image
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }
                
                $receipt->ocr_text = $outputText == '' ? null : mb_convert_encoding($outputText, 'UTF-8', 'UTF-8');
            }
        }

        $receipt->fill($input);
        $receipt->modifyBy = Auth::user()->id;
        $receipt->save();

        return redirect()->route('receipt.details.view', Crypt::encrypt($receipt->id))->with('success', 'Receipt updated successfully!');
    }

    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);

        // Assuming your Receipt model has a 'deletedBy' column
        $receipt->deletedBy = Auth::user()->id;
        $receipt->save();

        $receipt->delete();

        return redirect()->route('receipt.index')->with('success', __('Receipt deleted successfully.'));
    }

    public function receiptshare($id)
    {
        $inst = ContactDetails::all();
        $department = Department::all();
        $receipt = Receipt::findOrFail($id);
        $receiptid = $id;
        if (\Auth::user()->hasRole('admin')) {
            return view('receipt.share', compact('department', 'receipt', 'inst', 'receiptid'));
        } else {
            $url = 'receipt';
            return view('receipt.user.share', compact('url', 'department', 'receipt', 'inst', 'receiptid'));
        }
    }

    public function contactSuggestions(Request $request)
    {
        $term = $request->input('term');

        $contacts = User::where('name', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->limit(10)
            ->get();

        $results = [];

        foreach ($contacts as $contact) {
            $results[] = [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
            ];
        }


        return response()->json($results);
    }

    // public function receiptshare_store(Request $request)
    // {
    //     $request->validate([
    //         // 'department_id' => 'required',
    //         // 'section_id' => 'required',
    //     ]);
    //     $userId = Auth::id();
    //     $receiptshare = new Receiptshare();
    //     $receiptshare->receipt_id = $request->input('receipt_id');
    //     $receiptshare->recever_id = $request->input('recever');

    //     $receiptshare->remark = $request->input('remark');
    //     $receiptshare->due_date = $request->input('duedate');
    //     $receiptshare->action = $request->input('action');
    //     $receiptshare->priority = $request->input('priority');
    //     $receiptshare->sender_id = $userId;
    //     // $receiptshare->department_id = $request->input('department_id');
    //     // $receiptshare->section_id = $request->input('section_id');

    //     $receiptshare->save();
    //     return redirect()->route('receipt.index');
    // }

    public function receiptshare_store(Request $request)
    {
        $request->validate([
            'receipt_id' => 'required',
            'recever' => 'required',
            // You can add more validation as needed
        ]);

        $userId = Auth::id();

        // Save the primary 'To' share
        Receiptshare::create([
            'receipt_id' => $request->input('receipt_id'),
            'recever_id' => $request->input('recever'),
            'remark' => $request->input('remark'),
            'due_date' => $request->input('duedate'),
            'action' => $request->input('action'),
            'priority' => $request->input('priority'),
            'sender_id' => $userId,
            'share_type' => 'To', // Explicitly mark as To
        ]);

        // Save all CC shares (if any)
        if ($request->has('cc')) {
            foreach ($request->input('cc') as $ccUserId) {
                Receiptshare::create([
                    'receipt_id' => $request->input('receipt_id'),
                    'recever_id' => $ccUserId,
                    'remark' => $request->input('remark'),
                    'due_date' => $request->input('duedate'),
                    'action' => $request->input('action'),
                    'priority' => $request->input('priority'),
                    'sender_id' => $userId,
                    'share_type' => 'Cc', // Mark as Cc
                ]);
            }
        }

        // Also store in Movement table
        // Log movement for "To"
        // Movement::create([
        //     'receipt_id' => $request->input('receipt_id'),
        //     'from_user_id' => $userId,
        //     'to_user_id' => $request->input('recever'),
        //     'action' => 'SENT', // You can keep 'sent' or use 'sent_to' for clarity
        //     'remark' => 'Sent as primary recipient (To)',
        // ]);

        // // Log movements for each "Cc"
        // if ($request->has('cc')) {
        //     foreach ($request->input('cc') as $ccUserId) {
        //         Movement::create([
        //             'receipt_id' => $request->input('receipt_id'),
        //             'from_user_id' => $userId,
        //             'to_user_id' => $ccUserId,
        //             'action' => 'SENTcc', // Distinct action for CCs
        //             'remark' => 'Sent as carbon copy (Cc)',
        //         ]);
        //     }
        // }



        // dd($request->all());
        return redirect()->route('receipt.index')->with('success', 'Receipt shared successfully.');
    }


    public function inbox(ReceiptinboxDataTable $table)
    {

        $receipts = Receiptshare::where('recever_id', Auth::user()->id)
            ->with(['user', 'receipts'])
            ->orderBy('id', 'DESC')
            ->get()->map(function ($item) {
                $item->sender = $item->user->name;
                // $item->department = $item->departments->name;
                $item->receipt = $item->receipts->letter_ref_no ?? 'null';
                // $item->section = $item->section->name;

                return $item;
            });

        // if (\Auth::user()->hasRole('admin')) { 
        //     return view('receipt.inbox', compact('receipts'));
        // } else {
        //     $url = 'receipt';
        //     return view('receipt.user.userInbox', compact('url', 'receipts'));
        // }

        if (\Auth::user()->hasRole('admin')) {
            return $table->render('receipt.inbox');
        } else {
            $url = 'receipt';
            return $table->render('receipt.user.userInbox', compact('url'));
        }
    }

    public function sent(ReceiptshareDataTable $table)
    {
        if (\Auth::user()->hasRole('admin')) {
            return $table->render('receipt.sent');
        } else {
            $url = 'receipt';
            return $table->render('receipt.user.userSent', compact('url'));
        }
    }

    public function search(ReceiptsearchDataTable $table)
    {
        return $table->render('receipt.search');
    }

    public function receiptview_file($id)
    {

        $receipt = Receipt::findorfail($id);
        $url = 'receipt';
        if (\Auth::user()->hasRole('admin')) {
            return view('receipt.view', compact('receipt'));
        } else {
            $url = 'receipt';
            return view('receipt.user.viewReceipt', compact('url', 'receipt'));
        }
    }

    // public function pullBack($id)
    // {
    //     $share = Receiptshare::findOrFail($id);

    //     // Make sure current user is sender
    //     if ($share->sender_id != auth()->id()) {
    //         return response()->json(['message' => 'Unauthorized.'], 403);
    //     }

    //     // Don't allow pull back if the receiver has already read it
    //     if ($share->is_read) {
    //         return response()->json(['message' => 'Cannot pull back. Receiver has already read the receipt.'], 400);
    //     }

    //     $share->delete();

    //     return response()->json(['message' => 'Receipt pulled back successfully.']);
    // }

    // public function pullBack(Request $request, $id)
    // {
    //     $share = Receiptshare::findOrFail($id);

    //     // Make sure current user is sender
    //     if ($share->sender_id != auth()->id()) {
    //         return response()->json(['message' => 'Unauthorized.'], 403);
    //     }

    //     // Don't allow pull back if the receiver has already read it
    //     if ($share->is_read) {
    //         return response()->json(['message' => 'Cannot pull back. Receiver has already read the receipt.'], 400);
    //     }

    //     // Save pull back reason
    //     $share->pull_back_remark = $request->input('reason');
    //     $share->save();

    //     // Optionally: delete or soft-delete the record
    //     $share->delete();

    //     return response()->json(['message' => 'Receipt pulled back successfully.']);
    // }

    public function pullBack(Request $request, $id)
    {
        $share = Receiptshare::findOrFail($id);

        if ($share->sender_id != auth()->id()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($share->is_read) {
            return response()->json(['message' => 'Cannot pull back. Receiver has already read the receipt.'], 400);
        }

        // Update instead of deleting
        $share->is_pulled_back = true;
        $share->pull_back_remark = $request->input('reason'); // if applicable
        $share->save();

        // Log movement for pull back
        Movement::create([
            'receipt_id' => $share->receipt_id,
            'from_user_id' => auth()->id(),
            'to_user_id' => $share->recever_id,
            'action' => 'PULLBACK',
            'remark' => $request->input('reason') ?? 'Receipt pulled back',
        ]);

        return response()->json(['message' => 'Receipt pulled back successfully.']);
    }




    public function receipt_details_view($id)
    {
        try {
            $files = File::all();
            $receiptid = Crypt::decrypt($id);
            $copyreceiptid = $id;

            // check the receipt is read or not when creator sent this
            $receiptRecord = Receipt::find($receiptid);
            if ($receiptRecord->createdBy !== auth()->id()) {
                // Find the most recent active share for this user
                $share = Receiptshare::where('receipt_id', $receiptid)
                    ->where('recever_id', auth()->id())
                    ->where(function($query) {
                        $query->where('is_pulled_back', false)
                            ->orWhereNull('is_pulled_back');
                    })
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($share && !$share->is_read) {
                    $share->is_read = true;
                    $share->read_at = now(); // Add this if you want to track when it was read
                    $share->save();
                }
            }

            $communication = Communication::all();
            $deliverymode = Deliverymode::all();
            $sendertype = Sendertype::all();
            $vip = Vip::all();
            $ministry = Ministry::all();
            $country = Country::all();
            $state = State::all();
            $category = Category::all();
            $subcategory = Subcategory::all();
            $decryptedId = Crypt::decrypt($id);

            $receipt = Receipt::where('id', $decryptedId)
                ->with(['subCategory', 'Category', 'communication', 'delivery', 'sender', 'Vip', 'ministry', 'Country', 'State'])
                ->first();
            
            $receipt->communication = $receipt->communication->communication ?? 'N/A';
            $receipt->mode = $receipt->delivery->mode ?? 'N/A';
            $receipt->sender = $receipt->sender->sendertype ?? 'N/A';
            $receipt->vip = $receipt->Vip->name ?? 'N/A';

            $filePath = asset('public/assets/receipt/upload/' . $receipt->receipt_file);

            if (\Auth::user()->hasRole('admin')) {
                return view('receipt.user.edit', compact('receipt', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory'));
            } else {
                $url = 'receipt';
                if ($receipt->receipt_status == "Physical") {
                    return view('receipt.user.viewPhysical', compact('filePath', 'url', 'receipt', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory', 'receiptid', 'copyreceiptid', 'files'));
                } elseif ($receipt->receipt_status == "Electronics") {
                    return view('receipt.user.viewReceipt', compact('filePath', 'url', 'receipt', 'communication', 'deliverymode', 'sendertype', 'vip', 'ministry', 'country', 'state', 'category', 'subcategory', 'receiptid', 'copyreceiptid', 'files'));
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function sreceipt_details_view($id)
    // {

    // }

    
}
