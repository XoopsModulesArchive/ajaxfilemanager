<?php
/**
 * language pack
 * @author Andrea Cardinale (a.cardinale [at] webandtech [dot] it)
 * @link www.andrea-cardinale.it
 * @since 03/Dicembre/2010
 *
 */
define('DATE_TIME_FORMAT', 'd/m/Y H:i:s');

//Common

    //Menu
    define('MENU_SELECT', 'Seleziona');
    define('MENU_DOWNLOAD', 'Download');
    define('MENU_PREVIEW', 'Anteprima');
    define('MENU_RENAME', 'Rinomina');
    define('MENU_EDIT', 'Modifica');
    define('MENU_CUT', 'Taglia');
    define('MENU_COPY', 'Copia');
    define('MENU_DELETE', 'Elimina');
    define('MENU_PLAY', 'Play');
    define('MENU_PASTE', 'Incolla');
define('MENU_ZIP', 'Comprimi(zip)'); // XOOPS Ajax File Manager Module
define('MENU_UNZIP', 'Decomprimi(unzip)'); // XOOPS Ajax File Manager Module

//Label

    //Top Action
    define('LBL_ACTION_REFRESH', 'Aggiorna');
    define('LBL_ACTION_DELETE', 'Elimina');
    define('LBL_ACTION_CUT', 'Taglia');
    define('LBL_ACTION_COPY', 'Copia');
    define('LBL_ACTION_PASTE', 'Incolla');
    define('LBL_ACTION_CLOSE', 'Chiudi');
    define('LBL_ACTION_SELECT_ALL', 'Seleziona Tutto');
    //File Listing
    define('LBL_NAME', 'Nome');
    define('LBL_SIZE', 'Dimenzione');
    define('LBL_MODIFIED', 'Modificato il');
    //File Information
    define('LBL_FILE_INFO', 'Informazioni File:');
    define('LBL_FILE_NAME', 'Nome:');
    define('LBL_FILE_CREATED', 'Creato:');
    define('LBL_FILE_MODIFIED', 'Modificato:');
    define('LBL_FILE_SIZE', 'Dimensione:');
    define('LBL_FILE_TYPE', 'Tipo File:');
    define('LBL_FILE_WRITABLE', 'Scrivibile?');
    define('LBL_FILE_READABLE', 'Leggibile?');
    //Folder Information
    define('LBL_FOLDER_INFO', 'Informazioni Directory');
    define('LBL_FOLDER_PATH', 'Directory:');
    define('LBL_CURRENT_FOLDER_PATH', 'Percorso (path):');
    define('LBL_FOLDER_CREATED', 'Creato:');
    define('LBL_FOLDER_MODIFIED', 'Modificato:');
    define('LBL_FOLDER_SUDDIR', 'Sottodirectory:');
    define('LBL_FOLDER_FIELS', 'Files:');
    define('LBL_FOLDER_WRITABLE', 'Scrivibile?');
    define('LBL_FOLDER_READABLE', 'Leggibile?');
    define('LBL_FOLDER_ROOT', 'Root');
    //Preview
    define('LBL_PREVIEW', 'Anteprima');
    define('LBL_CLICK_PREVIEW', 'Clicca qui per l\\\'anteprima.');
    //Buttons
    define('LBL_BTN_SELECT', 'Seleziona');
    define('LBL_BTN_CANCEL', 'Cancella');
    define('LBL_BTN_UPLOAD', 'Upload');
define('LBL_BTN_UPLOADFTP', 'Upload Ftp'); // XOOPS Ajax File Manager Module
    define('LBL_BTN_CREATE', 'Crea');
    define('LBL_BTN_CLOSE', 'Chiudi');
    define('LBL_BTN_NEW_FOLDER', 'Nuova Directory');
    define('LBL_BTN_NEW_FILE', 'Nuovo File');
    define('LBL_BTN_EDIT_IMAGE', 'Modifica');
    define('LBL_BTN_VIEW', 'Seleziona Visualizzazione');
    define('LBL_BTN_VIEW_TEXT', 'Testo');
    define('LBL_BTN_VIEW_DETAILS', 'Dettagli');
    define('LBL_BTN_VIEW_THUMBNAIL', 'Thumbnails');
    define('LBL_BTN_VIEW_OPTIONS', 'Visualizza In:');
define('LBL_BTN_ZIP', 'Comprimi(zip)'); // XOOPS Ajax File Manager Module
define('LBL_BTN_UNZIP', 'Decomprimi(unzip)'); // XOOPS Ajax File Manager Module
    //pagination
    define('PAGINATION_NEXT', 'Prossimo');
    define('PAGINATION_PREVIOUS', 'Precedente');
    define('PAGINATION_LAST', 'Ultimo');
    define('PAGINATION_FIRST', 'Primo');
    define('PAGINATION_ITEMS_PER_PAGE', 'Visualizza %s elementi per pagina');
    define('PAGINATION_GO_PARENT', 'Vai alla directory superiore');
//Zip
define('ZIP_FORM_TITLE', 'Comprimi file'); // XOOPS Ajax File Manager Module
define('ZIP_NEW_NAME', 'Nome file compresso:'); // XOOPS Ajax File Manager Module
    //System
    define('SYS_DISABLED', 'Permesso negato: Il sistema &egrave; disabilitato.');
    //Cut
    define('ERR_NOT_DOC_SELECTED_FOR_CUT', 'Nessun file selezionato da tagliare.');
    //Copy
    define('ERR_NOT_DOC_SELECTED_FOR_COPY', 'Nessun file selezionato da copiare.');
    //Paste
    define('ERR_NOT_DOC_SELECTED_FOR_PASTE', 'Nessun file selezionato da incollare.');
    define('WARNING_CUT_PASTE', 'Sei sicuro di spostare i file selezionati nella directory attuale?');
    define('WARNING_COPY_PASTE', 'Sei sicuro di copiare i file selezionati nella directory attuale?');
    define('ERR_NOT_DEST_FOLDER_SPECIFIED', 'Nessuna directory di destinazione specificata.');
    define('ERR_DEST_FOLDER_NOT_FOUND', 'Directory di destinazione non trovata.');
    define('ERR_DEST_FOLDER_NOT_ALLOWED', 'Non ti &egrave; consentito spostare file in questa directory');
    define('ERR_UNABLE_TO_MOVE_TO_SAME_DEST', 'Spostamento fallito per questo file (%s): Percorso originale &egrave; lo stesso di quello di destinazione.');
    define('ERR_UNABLE_TO_MOVE_NOT_FOUND', 'Spostamento fallito per questo file (%s): Il file originale non esiste.');
    define('ERR_UNABLE_TO_MOVE_NOT_ALLOWED', 'Spostamento fallito per questo file (%s): Accesso negato per il file originale.');

    define('ERR_NOT_FILES_PASTED', 'Nessun file(s) da incollare.');

    //Search
    define('LBL_SEARCH', 'Cerca');
    define('LBL_SEARCH_NAME', 'Nome File Completo/Parziale:');
    define('LBL_SEARCH_FOLDER', 'Guarda in:');
    define('LBL_SEARCH_QUICK', 'Ricerca veloce');
    define('LBL_SEARCH_MTIME', 'Data modifica file(Range):');
    define('LBL_SEARCH_SIZE', 'Dimensione File:');
    define('LBL_SEARCH_ADV_OPTIONS', 'Opzioni avanzate');
    define('LBL_SEARCH_FILE_TYPES', 'Tipi di File:');
    define('SEARCH_TYPE_EXE', 'Applicazione');

    define('SEARCH_TYPE_IMG', 'Immagine');
    define('SEARCH_TYPE_ARCHIVE', 'Archivio');
    define('SEARCH_TYPE_HTML', 'HTML');
    define('SEARCH_TYPE_VIDEO', 'Video');
    define('SEARCH_TYPE_MOVIE', 'Video');
    define('SEARCH_TYPE_MUSIC', 'Musica');
    define('SEARCH_TYPE_FLASH', 'Flash');
    define('SEARCH_TYPE_PPT', 'PowerPoint');
    define('SEARCH_TYPE_DOC', 'File');
    define('SEARCH_TYPE_WORD', 'Word');
    define('SEARCH_TYPE_PDF', 'PDF');
    define('SEARCH_TYPE_EXCEL', 'Excel');
    define('SEARCH_TYPE_TEXT', 'Testo');
define('SEARCH_TYPE_KML', 'GoogleMaps Kml'); // XOOPS Ajax File Manager Module
    define('SEARCH_TYPE_UNKNOWN', 'Sconosciuto');
    define('SEARCH_TYPE_XML', 'XML');
    define('SEARCH_ALL_FILE_TYPES', 'Tutti i tipi di File');
    define('LBL_SEARCH_RECURSIVELY', 'Ricerca Ricorsivamente:');
    define('LBL_RECURSIVELY_YES', 'Si');
    define('LBL_RECURSIVELY_NO', 'No');
    define('BTN_SEARCH', 'Cerca Adesso');
    //thickbox
    define('THICKBOX_NEXT', 'Prossimo>');
    define('THICKBOX_PREVIOUS', '<Precedente');
    define('THICKBOX_CLOSE', 'Chiudi');
    //Calendar
    define('CALENDAR_CLOSE', 'Chiudi');
    define('CALENDAR_CLEAR', 'Pulisci');
    define('CALENDAR_PREVIOUS', '<Precedente');
    define('CALENDAR_NEXT', 'Prossimo>');
    define('CALENDAR_CURRENT', 'Oggi');
    define('CALENDAR_MON', 'Lun');
    define('CALENDAR_TUE', 'Mar');
    define('CALENDAR_WED', 'Mer');
    define('CALENDAR_THU', 'Gio');
    define('CALENDAR_FRI', 'Ven');
    define('CALENDAR_SAT', 'Sab');
    define('CALENDAR_SUN', 'Dom');
    define('CALENDAR_JAN', 'Gen');
    define('CALENDAR_FEB', 'Feb');
    define('CALENDAR_MAR', 'Mar');
    define('CALENDAR_APR', 'Apr');
    define('CALENDAR_MAY', 'Mag');
    define('CALENDAR_JUN', 'Giu');
    define('CALENDAR_JUL', 'Lug');
    define('CALENDAR_AUG', 'Ago');
    define('CALENDAR_SEP', 'Set');
    define('CALENDAR_OCT', 'Ott');
    define('CALENDAR_NOV', 'Nov');
    define('CALENDAR_DEC', 'Dic');

//ERROR MESSAGES
    //deletion
    define('ERR_NOT_FILE_SELECTED', 'Per favore seleziona un file.');
    define('ERR_NOT_DOC_SELECTED', 'Nessun file selezionato per l\\\'eliminazione.');
    define('ERR_DELTED_FAILED', 'Impossibile cancellare i file selezionati.');
    define('ERR_FOLDER_PATH_NOT_ALLOWED', 'Il percorso della directory non &egrave; consentito.');
    //class manager
    define('ERR_FOLDER_NOT_FOUND', 'Impossibile accedere alla directory specificata: ');
    //rename
    define('ERR_RENAME_FORMAT', 'Si prega di dare un nome che contenga solo lettere, cifre, spazio, trattino e underscore (_).');
    define('ERR_RENAME_EXISTS', 'Si prega di dare un nome che &egrave; unico nella directory.');
    define('ERR_RENAME_FILE_NOT_EXISTS', 'Il file/directory non esiste.');
    define('ERR_RENAME_FAILED', 'Impossibile rinominarlo, per favore riprova.');
    define('ERR_RENAME_EMPTY', 'Si prega di dare un nome.');
    define('ERR_NO_CHANGES_MADE', 'Nessuna modifica &egrave; stata fatta.');
    define('ERR_RENAME_FILE_TYPE_NOT_PERMITED', 'Non ti &egrave; permesso di modificare i file di tale estensione.');
    //folder creation
    define('ERR_FOLDER_FORMAT', 'Si prega di dare un nome che contenga solo lettere, cifre, spazio, trattino e underscore.');
    define('ERR_FOLDER_EXISTS', 'Si prega di dare un nome che &egrave; unico nella directory.');
    define('ERR_FOLDER_CREATION_FAILED', 'Impossibile creare una directory, per favore riprova.');
    define('ERR_FOLDER_NAME_EMPTY', 'Si prega di dare un nome.');
    define('FOLDER_FORM_TITLE', 'Modulo Nuova Directory');
    define('FOLDER_LBL_TITLE', 'Titolo Directory:');
    define('FOLDER_LBL_CREATE', 'Crea Directory');
    //file creation
    define('NEW_FILE_FORM_TITLE', 'Modulo nuovo File');
    define('NEW_FILE_LBL_TITLE', 'Nome File:');
    define('NEW_FILE_CREATE', 'Crea File');
//unzip
define('ERR_UNZIP_NOT_POSSIBLE_OVERWRITE', 'Non &egrave; possibile sovrascrivere file.'); // XOOPS Ajax File Manager Module
//zip
define('ERR_ZIP_EXIST', 'Prego inserire un nome inesistente.'); // XOOPS Ajax File Manager Module

    //file upload
    define('ERR_FILE_NAME_FORMAT', 'Si prega di dare un nome che contenga solo lettere, cifre, spazio, trattino e underscore.');
    define('ERR_FILE_NOT_UPLOADED', 'Nessun file &egrave; stato selezionato per l\\\'upload.');
    define('ERR_FILE_TYPE_NOT_ALLOWED', 'Non ti &egrave; permesso di caricare questo tipo di file.');
    define('ERR_FILE_MOVE_FAILED', 'Impossibile spostare il file.');
    define('ERR_FILE_NOT_AVAILABLE', 'Il file non &egrave; disponibile.');
    define('ERROR_FILE_TOO_BID', 'File troppo grande. (max: %s)');
    define('FILE_FORM_TITLE', 'Modulo Upload File');
    define('FILE_LABEL_SELECT', 'Seleziona File');
    define('FILE_LBL_MORE', 'Aggiungi Upload File');
    define('FILE_CANCEL_UPLOAD', 'Cancella Upload File');
    define('FILE_LBL_UPLOAD', 'Upload');
//file uploadftp
define('FILEFTP_FORM_TITLE', 'Upload file via FTP'); // XOOPS Ajax File Manager Module
define('FILE_CANCEL_UPLOADFTP', 'Annulla'); // XOOPS Ajax File Manager Module
define('FILE_LBL_UPLOADFTP', 'Upload Ftp'); // XOOPS Ajax File Manager Module
    //file download
    define('ERR_DOWNLOAD_FILE_NOT_FOUND', 'Nessun file selezionato per il download.');
    //Rename
    define('RENAME_FORM_TITLE', 'Modulo Rinomina');
    define('RENAME_NEW_NAME', 'Nuovo Nome');
    define('RENAME_LBL_RENAME', 'Rinomina');

    //Tips
    define('TIP_FOLDER_GO_DOWN', 'Singolo Click per andare in questa directory...');
    define('TIP_DOC_RENAME', 'Doppio Click per modificare...');
    define('TIP_FOLDER_GO_UP', 'Singolo Click per andare nella directory superiore...');
    define('TIP_SELECT_ALL', 'Seleziona Tutto');
    define('TIP_UNSELECT_ALL', 'Deseleziona Tutto');
    //WARNING
define('WARNING_UNZIP', 'Sei sicuro di volere scompattare(unzip) il file selezionato?'); // XOOPS Ajax File Manager Module
    define('WARNING_DELETE', 'Sei sicuro di voler cancellare il file selezionato?');
    define('WARNING_IMAGE_EDIT', 'Si prega di selezionare un\\\'immagine da modificare.');
    define('WARNING_NOT_FILE_EDIT', 'Si prega di selezionare un file da modificare.');
    define('WARING_WINDOW_CLOSE', 'Sei sicuro di chiudere la finestra?');
    //Preview
    define('PREVIEW_NOT_PREVIEW', 'Anteprima non disponibile.');
    define('PREVIEW_OPEN_FAILED', 'Impossibile aprire il file.');
    define('PREVIEW_IMAGE_LOAD_FAILED', 'Impossibile caricare l\\\'immagine');

    //Login
    define('LOGIN_PAGE_TITLE', 'Ajax File Manager Login Form');
    define('LOGIN_FORM_TITLE', 'Modulo Login');
    define('LOGIN_USERNAME', 'Username:');
    define('LOGIN_PASSWORD', 'Password:');
    define('LOGIN_FAILED', 'username/password non corretti.');


    //88888888888   Below for Image Editor   888888888888888888888
        //Warning
        define('IMG_WARNING_NO_CHANGE_BEFORE_SAVE', 'Non sono state apportate modifiche alle immagini.');

        //General
        define('IMG_GEN_IMG_NOT_EXISTS', 'L\\\'Immagine non esiste');
        define('IMG_WARNING_LOST_CHANAGES', 'Tutte le modifiche non salvate apportate all\\\'immagine verranno perse, sei sicuro di voler continuare?');
        define('IMG_WARNING_REST', 'Tutte le modifiche non salvate apportate all\\\'immagine andranno perse, sei sicuro di voler reimpostare?');
        define('IMG_WARNING_EMPTY_RESET', 'Nessuna modifica &egrave; stata fatta a immagine fino ad ora');
        define('IMG_WARING_WIN_CLOSE', 'Sei sicuro di chiudere la finestra?');
        define('IMG_WARNING_UNDO', 'Sei sicuro di voler ripristinare l\\\'immagine allo stato precedente?');
        define('IMG_WARING_FLIP_H', 'Sei sicuro di voler capovolgere l\\\'immagine orizzontalmente?');
        define('IMG_WARING_FLIP_V', 'Sei sicuro di capovolgere l\\\'immagine verticalmente');
        define('IMG_INFO', 'Informazioni Immagine');

        //Mode
            define('IMG_MODE_RESIZE', 'Ridimensiona:');
            define('IMG_MODE_CROP', 'Taglia:');
            define('IMG_MODE_ROTATE', 'Ruota:');
            define('IMG_MODE_FLIP', 'Capovolgi:');
        //Button

            define('IMG_BTN_ROTATE_LEFT', '90°CCW');
            define('IMG_BTN_ROTATE_RIGHT', '90°CW');
            define('IMG_BTN_FLIP_H', 'Capovolgi Orizontale');
            define('IMG_BTN_FLIP_V', 'Capovolgi Verticale');
            define('IMG_BTN_RESET', 'Ripristina');
            define('IMG_BTN_UNDO', 'Indietro');
            define('IMG_BTN_SAVE', 'Salva');
            define('IMG_BTN_CLOSE', 'Chiudi');
            define('IMG_BTN_SAVE_AS', 'Salva come');
            define('IMG_BTN_CANCEL', 'Cancella');
        //Checkbox
            define('IMG_CHECKBOX_CONSTRAINT', 'Vincola?');
        //Label
            define('IMG_LBL_WIDTH', 'Larghezza:');
            define('IMG_LBL_HEIGHT', 'Altezza:');
            define('IMG_LBL_X', 'X:');
            define('IMG_LBL_Y', 'Y:');
            define('IMG_LBL_RATIO', 'Rapporto:');
            define('IMG_LBL_ANGLE', 'Angolo:');
            define('IMG_LBL_NEW_NAME', 'nuovo Nome:');
            define('IMG_LBL_SAVE_AS', 'Salva come Modulo');
            define('IMG_LBL_SAVE_TO', 'Salva su:');
            define('IMG_LBL_ROOT_FOLDER', 'Directory Root');
        //Editor
        //Save as
        define('IMG_NEW_NAME_COMMENTS', 'Per favore, non contiene l\\\'estensione dell\\\'immagine.');
        define('IMG_SAVE_AS_ERR_NAME_INVALID', 'Si prega di dare un nome che contenga solo lettere, cifre, spazio, trattino e underscore.');
        define('IMG_SAVE_AS_NOT_FOLDER_SELECTED', 'Nessuna directory selezionata destinazione.');
        define('IMG_SAVE_AS_FOLDER_NOT_FOUND', 'La directory di destinazione non esiste.');
        define('IMG_SAVE_AS_NEW_IMAGE_EXISTS', 'Esiste una immagine con lo stesso nome.');

        //Save
        define('IMG_SAVE_EMPTY_PATH', 'Percorso immagine vuoto.');
        define('IMG_SAVE_NOT_EXISTS', 'Immagine non esiste.');
        define('IMG_SAVE_PATH_DISALLOWED', 'Non sei abilitato ad accedere a questo file.');
        define('IMG_SAVE_UNKNOWN_MODE', 'imprevisto Modalit&agrave; di funzionamento Immagine');
        define('IMG_SAVE_RESIZE_FAILED', 'Impossibile ridimensionare l\\\'immagine.');
        define('IMG_SAVE_CROP_FAILED', 'Impossibile ritagliare l\\\'immagine.');
        define('IMG_SAVE_FAILED', 'Impossibile salvare l\\\'immagine.');
        define('IMG_SAVE_BACKUP_FAILED', 'Impossibile eseguire il backup dell\\\'immagine originale.');
        define('IMG_SAVE_ROTATE_FAILED', 'Impossibile ruotare l\\\'immagine.');
        define('IMG_SAVE_FLIP_FAILED', 'Impossibile capovolgere l\\\'immagine.');
        define('IMG_SAVE_SESSION_IMG_OPEN_FAILED', 'Impossibile aprire l\\\'immagine per questa sessione.');
        define('IMG_SAVE_IMG_OPEN_FAILED', 'Impossibile aprire l\\\'immagine');

        
        //UNDO
        define('IMG_UNDO_NO_HISTORY_AVAIALBE', 'Nessuno storico disponibile per annullare.');
        define('IMG_UNDO_COPY_FAILED', 'Impossibile ripristinare l\\\'immagine.');
        define('IMG_UNDO_DEL_FAILED', 'Impossibile eliminare l\\\'immagine di sessione');

    //88888888888   Above for Image Editor   888888888888888888888

    //88888888888   Session   888888888888888888888
        define('SESSION_PERSONAL_DIR_NOT_FOUND', 'Impossibile trovare la directory dedicata che dovrebbe essere stata creata sotto la directory di sessione');
        define('SESSION_COUNTER_FILE_CREATE_FAILED', 'Impossibile aprire il file di conteggio sessione.');
        define('SESSION_COUNTER_FILE_WRITE_FAILED', 'Impossibile scrivere il file di conteggio sessione.');
    //88888888888   Session   888888888888888888888

    //88888888888   Below for Text Editor   888888888888888888888
        define('TXT_FILE_NOT_FOUND', 'File non trovato.');
        define('TXT_EXT_NOT_SELECTED', 'Si prega di selezionare l\\\'estensione del file');
        define('TXT_DEST_FOLDER_NOT_SELECTED', 'Si prega di selezionare la directory di destinazione');
        define('TXT_UNKNOWN_REQUEST', 'Richiesta Sconosciuta.');
        define('TXT_DISALLOWED_EXT', 'Hai il permesso di modificare/aggiungere questo tipo di file.');
        define('TXT_FILE_EXIST', 'Il File gi&agrave; esiste.');
        define('TXT_FILE_NOT_EXIST', 'Nessun file trovato.');
        define('TXT_CREATE_FAILED', 'Impossibile creare un nuovo file.');
        define('TXT_CONTENT_WRITE_FAILED', 'Impossibile scrivere il contenuto del file.');
        define('TXT_FILE_OPEN_FAILED', 'Impossibile aprire il file.');
        define('TXT_CONTENT_UPDATE_FAILED', 'Impossibile aggiornare il contenuto del file.');
        define('TXT_SAVE_AS_ERR_NAME_INVALID', 'Si prega di dare un nome che contenga solo lettere, cifre, spazio, trattino e underscore.');
    //88888888888   Above for Text Editor   888888888888888888888
?>