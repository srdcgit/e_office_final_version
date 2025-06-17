require('./bootstrap');
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import Table from '@ckeditor/ckeditor5-table/src/table';
import TableToolbar from '@ckeditor/ckeditor5-table/src/tabletoolbar';
import TableProperties from '@ckeditor/ckeditor5-table/src/tableproperties';
import TableCellProperties from '@ckeditor/ckeditor5-table/src/tablecellproperties';
import Clipboard from '@ckeditor/ckeditor5-clipboard/src/clipboard';

document.addEventListener('DOMContentLoaded', function() {
   ClassicEditor
      .create(document.querySelector('#description'), {
         plugins: [ Essentials, Paragraph, Bold, Italic, Table,TableOfContents, TableToolbar, TableProperties, TableCellProperties, Clipboard  ],
         toolbar: [ 'heading', '|', 'bold', 'italic', '|', 'insertTable', '|', 'undo', 'redo' ],
         table: {
            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties' ],
            tableToolbar: [ 'bold', 'italic' ]
         }
      })
      .then(editor => {
         console.log(editor);
      })
      .catch(error => {
         console.error(error);
      });
});
