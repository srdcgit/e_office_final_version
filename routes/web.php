<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\ModualController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\NoticeController; 
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PersonalNotesController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SenderTypeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TODOListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VipController;
use App\Http\Controllers\AttachReceiptController;
use App\Http\Controllers\CorrespondenceMovementController;
// use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'XSS', '2fa']);
Route::post('/chart', [HomeController::class, 'chart'])->name('get.chart.data')->middleware(['auth', 'XSS']);
Route::get('notification', [HomeController::class, 'notification']);
Route::group(['middleware' => ['auth', 'XSS']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('modules', ModualController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('subcategory', SubcategoryController::class);
    Route::resource('file', FileController::class);
    Route::resource('section', SectionController::class);
    route::resource('document', DocumentController::class);
    route::resource('share', ShareController::class);
    route::resource('deliverymode', DeliveryController::class);
    route::resource('vip', VipController::class);
    route::resource('sendertype', SenderTypeController::class);
    route::resource('communication', CommunicationController::class);
    route::resource('receipt', ReceiptController::class);
    route::resource('movements', MovementController::class);
    route::resource('template', TemplateController::class);
    route::resource('ministry', MinistryController::class);
    route::resource('notice', NoticeController::class);
    route::resource('correspondencemovement', CorrespondenceMovementController::class);
    Route::get('file/{id}/all-receipts', [FileController::class, 'mergeAllReceipts'])->name('file.mergeReceipts');
});
//dashboard routes for files
Route::get('get-files', [HomeController::class, 'file_inbox']);

//dashboard routes for Notice Board
Route::get('get-documents', [DocumentController::class, 'get_documents']);
Route::get('get-notices', [NoticeController::class, 'get_notices']);
Route::get('get-notice-details/{id}', [NoticeController::class, 'get_notice_details_by_id'])->name('get.notice.by.id');

Route::get('get-teams', [HomeController::class, 'getTeams']);

Route::post('user/status/change', [HomeController::class, 'change_status'])->name('change.user.status');

//dashboard routes for personal notes
Route::post('create/pnotes', [PersonalNotesController::class, 'create_notes'])->name('create.pnotes');
Route::get('get-pnotes', [PersonalNotesController::class, 'get_notes']);
Route::post('delete-notes-details', [PersonalNotesController::class, 'delete_notes']);
Route::get('get-notes-details/{id}', [PersonalNotesController::class, 'get_notes_details_by_id']);
Route::post('update-personal-notes', [PersonalNotesController::class, 'update_pnotes'])->name('update.pnotes');

//dashboard routes for todo
Route::get('get-todo-details', [TODOListController::class, 'get_todo']);
Route::get('get-todo-history', [TODOListController::class, 'get_todo_history']);
Route::get('get-todo-details/{id}', [TODOListController::class, 'get_todo_details_by_id']);
Route::post('delete-todo-details', [TODOListController::class, 'delete_todo']);
Route::post('done-todo', [TODOListController::class, 'change_status']);
Route::post('update-todo', [TODOListController::class, 'update_todo'])->name('update.todo');
Route::post('create/todo', [TODOListController::class, 'create_todo'])->name('create.todo');

Route::post('forwardfile', [FileController::class, 'forwardfilestore'])->name('forward.filestore');
Route::get('forward_file/{id}', [FileController::class, 'forwardfile'])->name('forward.file');
Route::post('/comments', [FileController::class, 'commentstore'])->name('comments.store');
Route::get('file_view/{id}/{file_share_id}', [FileController::class, 'viewfile'])->name('file.view');
// Route::put('/filestatus/{id}', [FileController::class, 'filesharestatusupdate'])->name('filestatus.update');
Route::post('correspondence/bulk-delete', [FileController::class, 'bulkDelete'])->name('correspondence.bulkDelete');

// Route::post('/correspondence/movement', [CorrespondenceMovementController::class, 'store'])->name('correspondence.movement.store');
// Route::get('/correspondence/file-movement/{file_notes_id}', [CorrespondenceMovementController::class, 'index'])->name('correspondence-movement.index');
Route::get('correspondence-movements/{file_notes_id}', [App\Http\Controllers\CorrespondenceMovementController::class, 'index'])->name('correspondence-movements.index');
Route::get('correspondence-movements/correspondence-details/{id}', [CorrespondenceMovementController::class, 'showCorrespondenceDetail'])->name('correspondence-movements.correspondence-details');

Route::get('user-detail/{id}', [CorrespondenceMovementController::class, 'detailModal']);
Route::get('correspondence-movements/user-details/{id}', [CorrespondenceMovementController::class, 'showModalSent'])->name('correspondence-movements.user-details');;


Route::get('notes_activity/{id}', [FileController::class, 'notesactivity'])->name('notes.activity');
Route::get('file_inbox', [FileController::class, 'fileinbox'])->name('file.inbox');
Route::get('file_sent', [FileController::class, 'filesent'])->name('file.sent');
Route::get('file_search', [FileController::class, 'filesearch'])->name('file.search');
Route::get('file_greennotes', [FileController::class, 'greennotes'])->name('file.greennotes');
Route::get('file_yellownotes', [FileController::class, 'yellownotes'])->name('file.yellownontes');
Route::get('fileshare/{id}', [FileController::class, 'fileshare'])->name('file.share');
Route::post('storeshare-file', [FileController::class, 'store_file_share'])->name('storefile.share');
Route::post('fileshares/pullback/{id}', [FileController::class, 'pullBack'])->name('fileshares.pullback');
Route::get('discard-notes/{id}', [FileController::class, 'discardnote'])->name('discard.notes');
Route::post('correspondance', [FileController::class, 'store_correspondance'])->name('correspondance.store');
Route::get('file-notes/{id}', [FileController::class, 'file_notes'])->name('file.notes');
Route::get('file-notes/{id}/{file_share_id}', [FileController::class, 'file_inbox_notes'])->name('file.inbox.notes');
Route::post('file-notes', [FileController::class, 'store_notes'])->name('store.notes');
Route::get('file-notesupdate/{id}', [FileController::class, 'notesupdate'])->name('notesupdate.notes');
Route::get('get-subcategory', [FileController::class, 'subcategory']);
Route::get('get-section', [FileController::class, 'getsection']);
Route::get('get-template', [FileController::class, 'gettemplate']);
Route::get('get-description', [FileController::class, 'getdescription']);

//Receipt routes starts from here
Route::get('receipt_inbox', [ReceiptController::class, 'inbox'])->name('receipt.inbox');
Route::get('receipt_inbox/user-details/{id}', [ReceiptController::class, 'showModal']);

Route::get('receipt_sent', [ReceiptController::class, 'sent'])->name('receipt.sent');
Route::get('receipt_sent/user-details/{id}', [ReceiptController::class, 'showModalSent']);
Route::get('receipt_search', [ReceiptController::class, 'search'])->name('receipt.search');
Route::get('receipt_share/{id}', [ReceiptController::class, 'receiptshare'])->name('receipt.share');
Route::get('receipt_viewfile/{id}', [ReceiptController::class, 'receiptview_file'])->name('receipt.view');
Route::get('receipt-details/view/{id}', [ReceiptController::class, 'receipt_details_view'])->name('receipt.details.view');
Route::delete('receipt/{receipt}', [ReceiptController::class, 'destroy'])->name('receipt.destroy');

Route::post('get-sender-detail', [MovementController::class, 'get_sender_detail'])->name('get.sender.detail');



// Reciept Folder Create 
Route::post('receipt/folders/create', [FolderController::class, 'create'])->name('receipt.folder.create');


Route::get('contact-suggestions', [ReceiptController::class, 'contactSuggestions'])->name('contact.suggestions');
Route::post('receiptshares/pullback/{id}', [ReceiptController::class, 'pullBack'])->name('receiptshares.pullback');

Route::post('receiptshare-store', [ReceiptController::class, 'receiptshare_store'])->name('receiptshare.store');
Route::get('user/receipt-create', [ReceiptController::class, 'user_create'])->name('user.receipt.create');
Route::get('get-contact-names', [ReceiptController::class, 'get_contact_names'])->name('get.contact.names');
Route::get('get-contact-by-phone', [ReceiptController::class, 'get_contact_by_phone'])->name('get.contact.by.phone');
Route::get('check-phone-exists', [ReceiptController::class, 'check_phone_exists'])->name('check.phone.exists');
Route::get('get-contact-details-by-id', [ReceiptController::class, 'get_contact_details_by_id'])->name('get.contact.details.by.id');
Route::post('get-sender-details', [ReceiptController::class, 'get_sender_details'])->name('get.sender.details');
Route::post('put-in-file', [ReceiptController::class, 'put_in_file'])->name('add.receipt.to.file');
Route::post('send-back-receipt', [ReceiptController::class, 'receipt_send_back'])->name('receipt.send.back');
Route::get('receeipt/convert/{id}', [ReceiptController::class, 'receipt_convert'])->name('receeipt.convert');
Route::post('physical/convert/electronics', [ReceiptController::class, 'convert_physical_receipt'])->name('convert.physical.details');


//Documents routes starts from here
// Route::post('/comments', [DocumentController::class, 'commentstore'])->name('comments.store');
Route::get('viewdocument/{id}', [DocumentController::class, 'view'])->name('view.document');
Route::get('uploaddocument/{id}', [DocumentController::class, 'upload_document'])->name('upload.document');
Route::get('document_sent', [DocumentController::class, 'documentsent'])->name('document.sent');
Route::get('document_inbox', [DocumentController::class, 'documentinbox'])->name('document.inbox');
Route::get('document_search', [DocumentController::class, 'documentsearch'])->name('document.search');
Route::get('get-user', [DocumentController::class, 'getuser']);
Route::get('select-user-for-file-share', [DocumentController::class, 'getUserForFileShare']);
Route::get('document_share/{id}', [DocumentController::class, 'share'])->name('document.share');

Route::post('storeshare', [DocumentController::class, 'store_share'])->name('store.share');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['auth', 'XSS']);
Route::post('/role/{id}', [RoleController::class, 'assignPermission'])->name('roles_permit')->middleware(['auth', 'XSS']);

Route::group(
    ['middleware' => ['auth', 'XSS']],
    function () {
        Route::get('setting/email-setting', [SettingController::class, 'getmail'])->name('settings.getmail');
        Route::post('setting/email-settings_store', [SettingController::class, 'saveEmailSettings'])->name('settings.emails');
        Route::get('setting/datetime', [SettingController::class, 'getdate'])->name('datetime');
        Route::post('setting/datetime-settings_store', [SettingController::class, 'saveSystemSettings'])->name('settings.datetime');
        Route::get('setting/logo', [SettingController::class, 'getlogo'])->name('getlogo');
        Route::post('setting/logo_store', [SettingController::class, 'store'])->name('settings.logo');
        Route::resource('settings', SettingController::class);
        Route::get('test-mail', [SettingController::class, 'testMail'])->name('test.mail');
        Route::post('test-mail', [SettingController::class, 'testSendMail'])->name('test.send.mail');
    }
);

Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(['auth', 'XSS']);
Route::post('edit-profile', [UserController::class, 'editprofile'])->name('update.profile')->middleware(['auth', 'XSS']);
Route::group(
    ['middleware' => ['auth', 'XSS']],
    function () {
        Route::get('change-language/{lang}', [LanguageController::class, 'changeLanquage'])->name('change.language');
        Route::get('manage-language/{lang}', [LanguageController::class, 'manageLanguage'])->name('manage.language');
        Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->name('store.language.data');
        Route::get('create-language', [LanguageController::class, 'createLanguage'])->name('create.language');
        Route::post('store-language', [LanguageController::class, 'storeLanguage'])->name('store.language');
        Route::delete('/lang/{lang}', [LanguageController::class, 'destroyLang'])->name('lang.destroy');
        Route::get('language', [LanguageController::class, 'index'])->name('index');
    }
);

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder')->middleware(['auth', 'XSS']);

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template')->middleware(['auth', 'XSS']);

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template')->middleware(['auth', 'XSS']);

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate')->middleware(['auth', 'XSS']);

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback')->middleware(['auth', 'XSS']);

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file')->middleware(['auth', 'XSS']);

Route::group(['prefix' => '2fa'], function () {
    Route::get('/', [UserController::class, 'profile'])->name('2fa')->middleware(['auth', 'XSS']);
    Route::post('/generateSecret', [LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret')->middleware(['auth', 'XSS']);
    Route::post('/enable2fa', [LoginSecurityController::class, 'enable2fa'])->name('enable2fa')->middleware(['auth', 'XSS']);
    Route::post('/disable2fa', [LoginSecurityController::class, 'disable2fa'])->name('disable2fa')->middleware(['auth', 'XSS']);

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});
// Route::resource('tests', App\Http\Controllers\TestController::class)->middleware(['auth', 'XSS']);


