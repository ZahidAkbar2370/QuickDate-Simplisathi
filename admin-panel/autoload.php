<?php
$dir = str_replace('admin-panel', '', dirname(__FILE__));
require_once($dir . '/bootstrap.php');

include 'function.php';

$page  = 'dashboard';


$pages = array('manage-stickers','manage-fakechat','show-fake-chat-users', 
    'manage-gifts',
    'add-new-gift',
    'add-new-sticker',
    'manage-photos',
    'general-settings',
    'dashboard',
    'site-settings',
    'dashboard',
    'site-features',
    'amazon-settings',
    'email-settings',
    'social-login',
    'chat-settings',
    'manage-languages',
    'add-language',
    'edit-lang',
    'manage-users',
    'manage-payments',
    'manage-profile-fields',
    'add-new-profile-field',
    'edit-profile-field',
    'manage-verification-reqeusts',
    'payment-reqeuests',
    'affiliates-settings',
    'referrals-list',
    'pro-memebers',
    'pro-settings',
    'payments',
    'payment-settings',
    'manage-pages',
    'manage-groups',
    'manage-posts',
    'manage-articles',
    'manage-events',
    'manage-forum-sections',
    'manage-forum-forums',
    'manage-forum-threads',
    'manage-forum-messages',
    'create-new-section',
    'create-new-forum',
    'manage-movies',
    'add-new-movies',
    'manage-games',
    'add-new-game',
    'ads-settings',
    'manage-site-ads',
    'manage-user-ads',
    'manage-site-design',
    'manage-announcements',
    'mailing-list',
    'mass-notifications',
    'ban-users',
    'generate-sitemap',
    'manage-invitation-keys',
    'backups',
    'manage-custom-pages',
    'add-new-custom-page',
    'edit-custom-page',
    'edit-terms-pages',
    'manage-reports',
    'push-notifications-system',
    'manage-api-access-keys',
    'verfiy-applications',
    'manage-updates',
    'changelog',
    'online-users',
    'custom-code',
    'manage-third-psites',
    'edit-movie',
    'auto-delete',
    'manage-themes',
    'change-site-desgin',
    'custom-design',
    'fake-users',
    'manage-announcements',
    'manage-genders',
    'add-genders',
    'edit-genders',
    'bank-receipts',
    'video-settings',
    'manage-website-ads',

    'manage-success-stories',
    'add-success-stories',
    'edit-success-stories',

    'add-new-article',
    'edit-new-article',
    'manage-blog-categories',
    'edit-article',
    'edit-blog-category',

    //'manage-user-verification',
    'push-notifications-system',
    'edit-user-permissions',

    'affiliates-settings',
    'payment-requests',
    'referrals-list',
    'mock-email',

    'pages-seo',

    'manage-countries',
    'add-countries',
    'edit-countries',

    'manage-verification-requests',
    'live',
    'manage-invitation',
    'manage-apps',
    'auto-like',
    'manage-faqs',
    'manage-currencies',
    'manage_terms_pages',
    'manage_emails',
    'system_status',
);

$mod_pages = $wo['mod_pages'] = array('dashboard', 'manage-users', 'online-users', 'manage-stories', 'manage-pages', 'manage-groups', 'manage-posts', 'manage-articles', 'manage-events', 'manage-forum-threads', 'manage-forum-messages', 'manage-movies', 'manage-games', 'add-new-game', 'manage-user-ads', 'manage-reports', 'manage-third-psites', 'edit-movie','live','manage-invitation','manage-invitation-keys','manage-apps','auto-like');
if (!empty($_GET['path'])) {
    $_GET['page'] = str_replace('/admin-panel/', '', $_GET['path']);
    $_GET['page'] = str_replace('/admin-cp/', '', $_GET['page']);
}
$_GET['page'] = str_replace('admin-cp/', '', $_GET['page']);
if (!empty($_GET['page'])) {
    $page = Secure($_GET['page'], 0);
}
if ($_GET['page'] == '/admin-cp' || $_GET['page'] == 'admin-cp') {
    $page = 'dashboard';
}
if ($page == 'dashboard') {
    //Wo_GetOfflineTyping();
    //Wo_DelexpiredEnvents();
}

if ($is_admin == false) {
    $authorized = false;
    if( $page == 'edit-user-permissions' ){
        if( CheckUserPermission($current_user_id, 'manage-users') === true ){
            $authorized = true;
        }
    }
    if( $page == 'add-genders' || $page == 'edit-genders' ){
        if( CheckUserPermission($current_user_id, 'manage-genders') === true ){
            $authorized = true;
        }
    }
    if( $page == 'add-countries' || $page == 'edit-countries' ){
        if( CheckUserPermission($current_user_id, 'manage-countries') === true ){
            $authorized = true;
        }
    }
    if( $page == 'manage-verification-requests'  ){
        if( CheckUserPermission($current_user_id, 'manage-verification-requests') === true ){
            $authorized = true;
        }
    }
    if( $page == 'edit-profile-field' || $page == 'add-new-profile-field' ){
        if( CheckUserPermission($current_user_id, 'manage-profile-fields') === true ){
            $authorized = true;
        }
    }
    if( $page == 'add-success-stories' || $page == 'edit-success-stories' ){
        if( CheckUserPermission($current_user_id, 'manage-success-stories') === true ){
            $authorized = true;
        }
    }
    if( $page == 'add-new-sticker' ){
        if( CheckUserPermission($current_user_id, 'manage-stickers') === true ){
            $authorized = true;
        }
    }
    if( $page == 'edit-article' ){
        if( CheckUserPermission($current_user_id, 'manage-articles') === true ){
            $authorized = true;
        }
    }
    if( $page == 'edit-lang' ){
        if( CheckUserPermission($current_user_id, 'manage-languages') === true ){
            $authorized = true;
        }
    }
    if( $page == 'edit-custom-page' || $page == 'add-new-custom-page' ){
        if( CheckUserPermission($current_user_id, 'manage-custom-pages') === true ){
            $authorized = true;
        }
    }

    if( CheckUserPermission($current_user_id, $page) === false && $page !== 'dashboard' && $authorized === false ){
        header("Location: " . $wo['site_url']);
        exit();
    }
//    if (!in_array($page, $mod_pages)) {
//        header("Location: " . $wo['site_url']);
//        exit();
//    }
}
if ($is_admin == false && !empty($wo['user']['permission'])) {
    $wo['user']['permission'] = json_decode($wo['user']['permission'],true);
    if (!in_array($page, array_keys($wo['user']['permission']))) {
        $wo['user']['permission'][$page] = 0;
        $permission = json_encode($wo['user']['permission']);
        $db->where('id',$wo['user']['id'])->update('users',array('permission' => $permission));
        header("Location: " . Wo_LoadAdminLinkSettings($page));
        exit();
    }
    else{
        if ($wo['user']['permission'][$page] == 0) {
            foreach ($wo['user']['permission'] as $key => $value) {
                if ($value == 1) {
                    header("Location: " . Wo_LoadAdminLinkSettings($key));
                    exit();
                }
            }
        }
    }
}
elseif ($is_admin == false && empty($wo['user']['permission'])) {
    $permission = array();
    if (!empty($wo['all_pages'])) {
        foreach ($wo['all_pages']  as $key => $value) {
            if (in_array($value,$wo['mod_pages'])) {
                $permission[$value] = 1;
            }
            else{
                $permission[$value] = 0;
            }
        }
    }
    $permission = json_encode($permission);
    $db->where('id',$wo['user']['id'])->update('users',array('permission' => $permission));
    $wo['user'] = Wo_UserData($wo['user']['id']);
}

$page_loaded = '';
if( $page == 'requests.php' ){
    require 'requests.php';
}
if (in_array($page, $pages)) {
    $page_loaded = Wo_LoadAdminPage("$page/content");
}
if (empty($page_loaded)) {
    global $wo;
    header("Location: " . $wo['site_url']);
    exit();
}
$notify_count = $db->where('recipient_id',0)->where('admin',1)->where('seen',0)->getValue('notifications','COUNT(*)');
$notifications = $db->where('recipient_id',0)->where('admin',1)->where('seen',0)->objectbuilder()->orderBy('id','DESC')->get('notifications');
$old_notifications = $db->where('recipient_id',0)->where('admin',1)->where('seen',0,'!=')->objectbuilder()->orderBy('id','DESC')->get('notifications',5);
$mode = 'day';
if (!empty($_COOKIE['mode']) && $_COOKIE['mode'] == 'night') {
    $mode = 'night';
}
if($page == "manage-fakechat"){
?>

<?php
if(isset($_POST["deleteconversation"])){
    $senderid = $_POST["senderid"];
    $recieverid = $_POST["recieverid"];

    $deleteConversation = "delete from conversations where sender_id = '$senderid' and receiver_id = '$recieverid'";
    $result = $db->query($deleteConversation);
    $deleteConversation1 = "delete from conversations where sender_id = '$recieverid' and receiver_id = '$senderid'";
    $result1 = $db->query($deleteConversation1);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>Chat App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        /* body {
            margin-top: 10px;
        } */

        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 380px;
            min-height: 380px;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0
        }

        .chat-message-left {
            margin-right: auto
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }

        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        .flex-grow-0 {
            flex-grow: 0 !important;
        }

        .border-top {
            border-top: 1px solid #dee2e6 !important;
        }

        .chatusers {
            display: flex;
            flex-direction: column;
            max-height: 530px;
            overflow-y: scroll
        }
    </style>
</head>

<body onload="reloadUsers()">
    <main class="content">
        <div class="bg-dark p-2">
            <a href="index.php" class="btn btn-primary">Main Website</a>
        <a href="dashboard" class="btn btn-primary">Dashbaord</a>
        </div>
        <div class="container-fluid">
            <!-- <a href="#">Home</a> -->
            <h1 class="h3 mb-3 mt-3">Messages</h1>
            
            <div class="card">
                <div class="row g-0" id="main-chat-row">
                    <div class="col-12 col-lg-5 col-xl-3 border-right chatusers">
                        <div class="px-4 d-none d-md-block my-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <!-- <input type="text" class="form-control my-3" placeholder="Search..."> -->
                                </div>
                            </div>
                        </div>

                       <div id="chatusers">
                            <div id="showchatusers">

                            </div>
                       </div>

                        <!-- users who did chat -->
                        <!-- <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="badge bg-success float-right"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="15" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="id1"><path d="M 3.460938 6.5625 L 26.539062 6.5625 L 26.539062 24.707031 L 3.460938 24.707031 Z M 3.460938 6.5625 " clip-rule="nonzero" fill="#00ff11"></path></clipPath></defs><g clip-path="url(#id1)"><path fill="#00ff11" d="M 24.230469 11.101562 L 15 16.769531 L 5.769531 11.101562 L 5.769531 8.832031 L 15 14.503906 L 24.230469 8.832031 Z M 24.230469 6.5625 L 5.769531 6.5625 C 4.492188 6.5625 3.472656 7.578125 3.472656 8.832031 L 3.460938 22.441406 C 3.460938 23.695312 4.492188 24.707031 5.769531 24.707031 L 24.230469 24.707031 C 25.507812 24.707031 26.539062 23.695312 26.539062 22.441406 L 26.539062 8.832031 C 26.539062 7.578125 25.507812 6.5625 24.230469 6.5625 " fill-opacity="1" fill-rule="nonzero"></path></g></svg></div>
                            <div class="d-flex align-items-start">
                                <img src="https://bootdey.com/img/Content/avatar/avatar5.png"
                                    class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    Zahid Akbar
                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="badge bg-success float-right"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="15" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="id1"><path d="M 3.460938 6.5625 L 26.539062 6.5625 L 26.539062 24.707031 L 3.460938 24.707031 Z M 3.460938 6.5625 " clip-rule="nonzero" fill="#00ff11"></path></clipPath></defs><g clip-path="url(#id1)"><path fill="#00ff11" d="M 24.230469 11.101562 L 15 16.769531 L 5.769531 11.101562 L 5.769531 8.832031 L 15 14.503906 L 24.230469 8.832031 Z M 24.230469 6.5625 L 5.769531 6.5625 C 4.492188 6.5625 3.472656 7.578125 3.472656 8.832031 L 3.460938 22.441406 C 3.460938 23.695312 4.492188 24.707031 5.769531 24.707031 L 24.230469 24.707031 C 25.507812 24.707031 26.539062 23.695312 26.539062 22.441406 L 26.539062 8.832031 C 26.539062 7.578125 25.507812 6.5625 24.230469 6.5625 " fill-opacity="1" fill-rule="nonzero"></path></g></svg></div>
                            <div class="d-flex align-items-start">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                    class="rounded-circle mr-1" alt="William Harris" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    Janu Jakhar
                                    <div class="small"><span class="fas fa-circle chat-online"></span> Offline</div>
                                </div>
                            </div>
                        </a> -->


                        <hr class="d-block d-lg-none mt-1 mb-0">
                    </div>
                    <div class="col-12 col-lg-7 col-xl-9">
                        <div class="row" id="chat-main-container">
                           <div class="col-lg-12">
                            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                <div class="d-flex align-items-center py-1">
                                    <!-- <div class="position-relative">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                            class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    </div> -->
                                    <div class="flex-grow-1 pl-3">
                                        <strong>Conversation</strong>
                                    </div>
                                    <div>
                                        <button class="btn border btn-lg mr-1 px-3" id="showuserdetail"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-users">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg></button>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative" id="chat_container">
                                <div class="chat-messages p-4" id="chat_result">
                                     <!-- <div class="chat-message-right pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                        </div>
                                    </div> -->
                                  <!--  <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">Janu Jakhar</div>
                                            Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                        </div>
                                    </div>
                                    <div class="chat-message-right mb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:35 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            Cum ea graeci tractatos.
                                        </div>
                                    </div>
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:36 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">Janu Jakhar</div>
                                            Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae
                                            commodo lectus mauris et velit.
                                            Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
                                        </div>
                                    </div>
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:37 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">Janu Jakhar</div>
                                            Cras pulvinar, sapien id vehicula aliquet, diam velit elementum orci.
                                        </div>
                                    </div>
                                    <div class="chat-message-right mb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:38 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                        </div>
                                    </div>
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:39 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">Janu Jakhar</div>
                                            Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                        </div>
                                    </div>
                                    <div class="chat-message-right mb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:40 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            Cum ea graeci tractatos.
                                        </div>
                                    </div>
                                    <div class="chat-message-right mb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:41 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            Morbi finibus, lorem id placerat ullamcorper, nunc enim ultrices massa, id
                                            dignissim metus urna eget purus.
                                        </div>
                                    </div>
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:42 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">Janu Jakhar</div>
                                            Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae
                                            commodo lectus mauris et velit.
                                            Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
                                        </div>
                                    </div>
                                    <div class="chat-message-right mb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:43 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                        </div>
                                    </div>
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:44 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">Janu Jakhar</div>
                                            Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <form action="<?php echo $site_url; ?>/aj/chat/send_message_fk_admin" id="chat_message_form" method="post">
                                <div class="input-group">

                                    
                                <input type="hidden" name="to" value="" id="to_message"/>
	                            <input type="hidden" name="from" value="" id="from_message"/>
                                    <input type="text" class="form-control dt_emoji1" placeholder="Type your message" name="text" required="" id="dt_emoji">
                                    <!-- <a class="msg_send_btn1" data-input="thumbnail" data-preview="holder" type="button"
                                        id="image"><i class="fa fa-paperclip" aria-hidden="true"></i></a> -->
                                    <button type="submit"  id="btn_chat_f_send" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16"> <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/> </svg></button>
                                </div>
                            </form>
                            </div>
                           </div>
                           <!-- <div style="width: 20%;" id="col-test">

                                <div class="card">
                                    <img class="card-img-top" src="..." alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                           </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
<div class="modal fade" id="userinformationmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                From: <span id="username"></span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Email:</strong><br><small id="useremail"></small></li>
                                <li class="list-group-item"><strong>Balance: </strong><span id="userbalance"></span></li>
                                <li class="list-group-item"><strong>Created at:</strong><br><span id="usercreated_at"></span></li>
                                <li class="list-group-item"><strong>Lat: </strong><span id="userlat"></span></li>
                                <li class="list-group-item"><strong>Lng: </strong><span id="userlng"></span></li>
                                <li class="list-group-item"><strong>Verified: </strong><br><span id="userverified"></span></li>
                                <li class="list-group-item"><strong>Gender: </strong><br><span id="usergender"></span></li>
                             </ul>
                            </div>
                </div>


                <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                To: <span id="username1"></span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Email:</strong><br><small id="useremail1"></small></li>
                                <li class="list-group-item"><strong>Balance: </strong><span id="userbalance1"></span></li>
                                <li class="list-group-item"><strong>Created at:</strong><br><span id="usercreated_at1"></span></li>
                                <li class="list-group-item"><strong>Lat: </strong><span id="userlat1"></span></li>
                                <li class="list-group-item"><strong>Lng: </strong><span id="userlng1"></span></li>
                                <li class="list-group-item"><strong>Verified: </strong><br><span id="userverified1"></span></li>
                                <li class="list-group-item"><strong>Gender: </strong><br><span id="usergender1"></span></li>
                             </ul>
                            </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="" method="post">
            <input type="hidden" name="senderid" id="deletesenderid">
            <input type="hidden" name="recieverid" id="deleterecieverid">
            <button type="submit" class="btn btn-danger" name="deleteconversation" onclick="return confirm('Are you Sure to Delete This conversation?');">Delete Conversation</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
    <script>
        function Wo_Ajax_Requests_File(){
            return "<?php echo $wo['config']['site_url'].'/admin-panel/requests.php';?>"
        }
    </script>
    <script src="https://www.simplisathi.com/themes/love/assets/js/chat.js?v=1690446053" type="text/javascript" id="chat-script"></script>

<script type="text/javascript">
    function scrollToBottom() {
            var scrollBox = document.getElementById('chat_result');
            scrollBox.scrollTop = scrollBox.scrollHeight;
    }

    function viewChat(senderid,receiverid, reload = "bottom") {

        // userinformation(senderid, receiverid);
$.post(Wo_Ajax_Requests_File() + '?f=getchat&senderid='+senderid+'&receiverid='+receiverid, function (data) {
    if(data.status==200){
           $('#chat_result').html(data.chat);
           $('#to_message').val(receiverid);
           $('#from_message').val(senderid);
           
           $("#chat_container").animate({ scrollTop: $('#chat_container').prop("scrollHeight")}, 1000);
           if(reload == "bottom"){
            scrollToBottom();
           }

        //    $('.dt_emoji1').val('');
        //    $('.dt_emoji1').focus();
        // alert("hello");

       }
    });
    
    
};

function userinformation() {

    var to = document.getElementById('to_message').value; 
      var from = document.getElementById('from_message').value;

      if(to != '' && from != ''){
          $.get(Wo_Ajax_Requests_File() + '?f=getuserinformation&senderid='+from+'&receiverid='+to, function (data) {
              console.log(data);
              });
      }
    
    
};

function reloadChat() {
      var to = document.getElementById('to_message').value; 
      var from = document.getElementById('from_message').value;
	  if(to != '' && from != ''){
		viewChat(from, to , "reload");
	  }
    }

	setInterval(reloadChat, 2000);
  

    

function reloadUsers(){
        // $('#showchatusers').empty();

        $.get(Wo_Ajax_Requests_File() + '?f=reloaduser&username=', function (data) {
    if(data){
           $('#showchatusers').html(data);
           $("#chatusers").animate({ scrollTop: $('#chatusers').prop("scrollHeight")}, 1000);
           

       }
    });
}
setInterval(reloadUsers, 10000);

    // // Set up the onclick event for the button
    // $(document).ready(function() {
    //   $("#loadPHPContentBtn").on("click", showChatUsers);
    // });


    
    var columnWidthIsFull = true;
    document.getElementById('showuserdetail').addEventListener('click', function () {
        
        var to = document.getElementById('to_message').value; 
      var from = document.getElementById('from_message').value;

      if(to != '' && from != ''){
          $.get(Wo_Ajax_Requests_File() + '?f=getuserinformation&senderid='+from+'&receiverid='+to, function (data) {
            //   console.log(data);
            //   console.log(data[1][0]["username"]);

            var gender = "Unknown";
                if(data[0][0]["gender"] == "4525"){
                    gender = "female";
                }

                if(data[0][0]["gender"] == "4526"){
                    gender = "male";
                }

                document.getElementById("usergender").innerHTML = gender;

                document.getElementById("deletesenderid").value = data[0][0]["id"];
                document.getElementById("username").innerHTML = data[0][0]["username"];
                document.getElementById("useremail").innerHTML = data[0][0]["email"];
                document.getElementById("userbalance").innerHTML = data[0][0]["balance"];
                document.getElementById("usercreated_at").innerHTML = data[0][0]["created_at"];
                document.getElementById("userlat").innerHTML = data[0][0]["lat"];
                document.getElementById("userlng").innerHTML = data[0][0]["lng"];
                document.getElementById("userverified").innerHTML = data[0][0]["verified"];

                var gender1 = "Unknown";
                if(data[1][0]["gender"] == "4525"){
                    gender1 = "female";
                }

                if(data[1][0]["gender"] == "4526"){
                    gender1 = "male";
                }

                document.getElementById("usergender1").innerHTML = gender1;

                document.getElementById("deleterecieverid").value = data[1][0]["id"];
                document.getElementById("username1").innerHTML = data[1][0]["username"];
                document.getElementById("useremail1").innerHTML = data[1][0]["email"];
                document.getElementById("userbalance1").innerHTML = data[1][0]["balance"];
                document.getElementById("usercreated_at1").innerHTML = data[1][0]["created_at"];
                document.getElementById("userlat1").innerHTML = data[1][0]["lat"];
                document.getElementById("userlng1").innerHTML = data[1][0]["lng"];
                document.getElementById("userverified1").innerHTML = data[1][0]["verified"];

              $("#userinformationmodel").modal("show");
              });
      }

        // var secondColumn = document.getElementById('chat-main-container');
        // var coltest = document.getElementById('col-test');

        // if (columnWidthIsFull) {
        //     secondColumn.style.width = '75%';
        //     columnWidthIsFull = false;
        //     coltest.style.display = "block";
        // } else {
        //     secondColumn.style.width = '100%';
        //     columnWidthIsFull = true;
        //     coltest.style.display = "none";
        // }
    });
  </script>
</body>

</html>


<?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel | <?php echo $wo['config']['siteTitle']; ?></title>
    <link rel="icon" href="<?php echo $wo['config']['sitelogo']; ?>" type="image/png">


    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo(Wo_LoadAdminLink('vendors/bundle.css')) ?>" type="text/css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="<?php echo(Wo_LoadAdminLink('vendors/datepicker/daterangepicker.css')) ?>" type="text/css">

    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo(Wo_LoadAdminLink('vendors/dataTable/datatables.min.css')) ?>" type="text/css">

<!-- App css -->
    <link rel="stylesheet" href="<?php echo(Wo_LoadAdminLink('assets/css/app.css')) ?>" type="text/css">
    <!-- Main scripts -->
<script src="<?php echo(Wo_LoadAdminLink('vendors/bundle.js')) ?>"></script>

    <!-- Apex chart -->
    <script src="<?php echo(Wo_LoadAdminLink('vendors/charts/apex/apexcharts.min.js')) ?>"></script>

    <!-- Daterangepicker -->
    <script src="<?php echo(Wo_LoadAdminLink('vendors/datepicker/daterangepicker.js')) ?>"></script>

    <!-- DataTable -->
    <script src="<?php echo(Wo_LoadAdminLink('vendors/dataTable/datatables.min.js')) ?>"></script>

    <!-- Dashboard scripts -->
    <script src="<?php echo(Wo_LoadAdminLink('assets/js/examples/pages/dashboard.js')) ?>"></script>
    <script src="<?php echo Wo_LoadAdminLink('vendors/charts/chartjs/chart.min.js'); ?>"></script>

<!-- App scripts -->
<link href="<?php echo Wo_LoadAdminLink('vendors/sweetalert/sweetalert.css'); ?>" rel="stylesheet" />
<script src="<?php echo Wo_LoadAdminLink('assets/js/admin.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo(Wo_LoadAdminLink('vendors/select2/css/select2.min.css')) ?>" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<script src="<?php echo Wo_LoadAdminLink('vendors/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script src="<?php echo Wo_LoadAdminLink('vendors/bootstrap-tagsinput/src/bootstrap-tagsinput.js'); ?>"></script>
<link href="<?php echo Wo_LoadAdminLink('vendors/bootstrap-tagsinput/src/bootstrap-tagsinput.css'); ?>" rel="stylesheet" />
<script src="<?php echo Wo_LoadAdminLink('vendors/codemirror-5.30.0/lib/codemirror.js'); ?>"></script>
<script src="<?php echo Wo_LoadAdminLink('vendors/codemirror-5.30.0/mode/css/css.js'); ?>"></script>
<script src="<?php echo Wo_LoadAdminLink('vendors/codemirror-5.30.0/mode/javascript/javascript.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo Wo_LoadAdminLink('vendors/codemirror-5.30.0/lib/codemirror.css'); ?>">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- Css -->
        <link rel="stylesheet" href="<?php echo(Wo_LoadAdminLink('vendors/lightbox/magnific-popup.css')) ?>" type="text/css">

        <!-- Javascript -->
        <script src="<?php echo(Wo_LoadAdminLink('vendors/lightbox/jquery.magnific-popup.min.js')) ?>"></script>
        <script src="<?php echo(Wo_LoadAdminLink('vendors/charts/justgage/raphael-2.1.4.min.js')) ?>"></script>
        <script src="<?php echo(Wo_LoadAdminLink('vendors/charts/justgage/justgage.js')) ?>"></script>
    <script src="<?php echo Wo_LoadAdminLink('assets/js/jquery.form.min.js'); ?>"></script>
    <script>
        function Wo_Ajax_Requests_File(){
            return "<?php echo $wo['config']['site_url'].'/admin-panel/requests.php';?>"
        }
    </script>
    <style>
        .btn.btn-primary, a.btn[href="#next"], a.btn[href="#previous"] {color: #fff !important;background: #CC42BD;border-color: #CC42BD;}
        .btn.btn-primary:not(:disabled):not(.disabled):hover, a.btn[href="#next"]:not(:disabled):not(.disabled):hover, a.btn[href="#previous"]:not(:disabled):not(.disabled):hover, .btn.btn-primary:not(:disabled):not(.disabled):focus, a.btn[href="#next"]:not(:disabled):not(.disabled):focus, a.btn[href="#previous"]:not(:disabled):not(.disabled):focus, .btn.btn-primary:not(:disabled):not(.disabled):active, a.btn[href="#next"]:not(:disabled):not(.disabled):active, a.btn[href="#previous"]:not(:disabled):not(.disabled):active, .btn.btn-primary:not(:disabled):not(.disabled).active, a.btn[href="#next"]:not(:disabled):not(.disabled).active, a.btn[href="#previous"]:not(:disabled):not(.disabled).active {background: #bc40ad;border-color: #bc40ad;}
        body.dark .navigation .navigation-menu-body ul li a.active, .breadcrumb .breadcrumb-item.active, body.dark .breadcrumb li.breadcrumb-item.active, body.dark .navigation .navigation-menu-body ul li a.active .nav-link-icon {color: #CC42BD !important;}
        .card form .form-check-inline input:checked {background-color: #CC42BD;}
        .card form .form-check-inline input:checked + label::before, .card form .form-check-inline input:active + label::before {border-color: #CC42BD;}
        .card form .form-check-inline label::after {background-color: #CC42BD;}
        .select2-container--default.select2-container--focus .select2-selection--multiple {border: 2px solid #CC42BD !important;}
    </style>
</head>
<script type="text/javascript">
    function Wo_Ajax_Requests_File_load(){
        return "<?php echo $wo['config']['site_url'].'/admin_load.php';?>"
    }
    $(function() {
        $(document).on('click', 'a[data-ajax]', function(e) {
            $(document).off('click', '.ranges ul li');
            $(document).off('click', '.applyBtn');
            e.preventDefault();
            if (($(this)[0].hasAttribute("data-sent") && $(this).attr('data-sent') == '0') || !$(this)[0].hasAttribute("data-sent")) {
                if (!$(this)[0].hasAttribute("data-sent") && !$(this).hasClass('waves-effect')) {
                    $('.navigation-menu-body').find('a').removeClass('active');
                    $(this).addClass('active');
                }
                window.history.pushState({state:'new'},'', $(this).attr('href'));
                $(".barloading").css("display","block");
                if ($(this)[0].hasAttribute("data-sent")) {
                    $(this).attr('data-sent', "1");
                }
                var url = $(this).attr('data-ajax');
                $.post(Wo_Ajax_Requests_File_load() + url, {url:url}, function (data) {
                    $(".barloading").css("display","none");
                    if ($('#redirect_link')[0].hasAttribute("data-sent")) {
                        $('#redirect_link').attr('data-sent', "0");
                    }
                    json_data = JSON.parse($(data).filter('#json-data').val());
                    $('.content').html(data);
                    setTimeout(function () {
                      $(".content").getNiceScroll().resize()
                    }, 500);
                    $(".content").animate({ scrollTop: 0 }, "slow");
                });
            }
        });
        $(window).on("popstate", function (e) {
            location.reload();
        });
        let container_fluid_height = $('.container-fluid').height();
        
        setInterval(function () {
            if (container_fluid_height != $('.container-fluid').height()) {
                container_fluid_height = $('.container-fluid').height();
                $(".content").getNiceScroll().resize();
            }
        },500);
    });
</script>
<body <?php echo ($mode == 'night' ? 'class="dark"' : ''); ?>>
    <div class="barloading"></div>
    <a id="redirect_link" href="" data-ajax="" data-sent="0"></a>
    <input type="hidden" class="main_session" value="<?php echo Wo_CreateMainSession();?>">
    <div class="colors"> <!-- To use theme colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-bright"></div>
        <div class="bg-secondary"></div>
        <div class="bg-secondary-bright"></div>
        <div class="bg-info"></div>
        <div class="bg-info-bright"></div>
        <div class="bg-success"></div>
        <div class="bg-success-bright"></div>
        <div class="bg-danger"></div>
        <div class="bg-danger-bright"></div>
        <div class="bg-warning"></div>
        <div class="bg-warning-bright"></div>
    </div>
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-icon"></div>
    <span>Loading...</span>
</div>
<!-- ./ Preloader -->

<!-- Sidebar group -->
<div class="sidebar-group">

</div>
<!-- ./ Sidebar group -->

<!-- Layout wrapper -->
<div class="layout-wrapper">

    <!-- Header -->
    <div class="header d-print-none">
        <div class="header-container">
            <div class="header-left">
                <div class="navigation-toggler">
                    <a href="#" data-action="navigation-toggler">
                        <i data-feather="menu"></i>
                    </a>
                </div>

                <div class="header-logo">
                    <a href="<?php echo $wo['config']['site_url'] ?>">
                        <img class="logo" src="<?php echo $wo['config']['theme_url']; ?>/assets/img/logo.png" alt="logo">
                    </a>
                </div>
            </div>

            <div class="header-body">
                <div class="header-body-left">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-3">
                            <div class="header-search-form">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn">
                                            <i data-feather="search"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search"  onkeyup="searchInFiles($(this).val())">
                                    <div class="pt_admin_hdr_srch_reslts" id="search_for_bar"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="header-body-right">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link <?php if ($notify_count > 0) { ?> nav-link-notify<?php } ?>" title="Notifications" data-toggle="dropdown">
                                <i data-feather="bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div
                                    class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Notifications</h5>
                                    <?php if ($notify_count > 0) { ?>
                                    <small class="opacity-7"><?php echo $notify_count; ?>   unread notifications</small>
                                    <?php } ?>
                                </div>
                                <div class="dropdown-scroll">
                                    <ul class="list-group list-group-flush">
                                        <?php if ($notify_count > 0) { ?>
                                            <li class="px-4 py-2 text-center small text-muted bg-light">Unread Notifications</li>
                                            <?php if (!empty($notifications)) { 
                                                    foreach ($notifications as $key => $notify) {
                                                        $page_ = '';
                                                        $text = '';
                                                        if ($notify->type == 'bank') {
                                                            $page_ = 'bank-receipts';
                                                            $text = 'You have a new bank payment awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'verify') {
                                                            $page_ = 'manage-verification-requests';
                                                            $text = 'You have a new verification requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'verify_user') {
                                                            $page_ = 'manage-users';
                                                            $text = 'You have a new users awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'with') {
                                                            $page_ = 'payment-requests';
                                                            $text = 'You have a new withdrawal requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'report') {
                                                            $page_ = 'manage-reports';
                                                            $text = 'You have a new reports awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'image') {
                                                            $page_ = 'manage-photos';
                                                            $text = 'You have a new images awaiting your approval';
                                                        }
                                                ?>
                                            <li class="px-4 py-3 list-group-item">
                                                <a href="<?php echo Wo_LoadAdminLinkSettings($page_); ?>" class="d-flex align-items-center hide-show-toggler">
                                                    <div class="flex-shrink-0">
                                                        <figure class="avatar mr-3">
                                                            <span
                                                                class="avatar-title bg-info-bright text-info rounded-circle">
                                                                <?php if ($notify->type == 'bank') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                                                <?php }elseif ($notify->type == 'verify' || $notify->type == 'verify_user') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196f3" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"></path></svg>
                                                                <?php }elseif ($notify->type == 'refund') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                                                <?php }elseif ($notify->type == 'with') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                                                <?php }elseif ($notify->type == 'report') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                                                <?php } elseif ($notify->type == 'image') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196f3" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"></path></svg>
                                                                <?php } ?>
                                                                
                                                            </span>
                                                        </figure>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                            <?php echo $text; ?>
                                                        </p>
                                                        <span class="text-muted small"><?php echo Time_Elapsed_String($notify->created_at); ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php } } ?>
                                        <?php } ?>
                                        <?php if ($notify_count == 0 && !empty($old_notifications)) { ?>
                                            <li class="px-4 py-2 text-center small text-muted bg-light">Old Notifications</li>
                                            <?php
                                                    foreach ($old_notifications as $key => $notify) {
                                                        $page_ = '';
                                                        $text = '';
                                                        if ($notify->type == 'bank') {
                                                            $page_ = 'bank-receipts';
                                                            $text = 'You have a new bank payment awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'verify') {
                                                            $page_ = 'manage-verification-requests';
                                                            $text = 'You have a new verification requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'verify_user') {
                                                            $page_ = 'manage-users';
                                                            $text = 'You have a new users awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'with') {
                                                            $page_ = 'payment-requests';
                                                            $text = 'You have a new withdrawal requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'report') {
                                                            $page_ = 'manage-reports';
                                                            $text = 'You have a new reports awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'image') {
                                                            $page_ = 'manage-photos';
                                                            $text = 'You have a new images awaiting your approval';
                                                        }
                                                ?>
                                            <li class="px-4 py-3 list-group-item">
                                                <a href="<?php echo Wo_LoadAdminLinkSettings($page_); ?>" class="d-flex align-items-center hide-show-toggler">
                                                    <div class="flex-shrink-0">
                                                        <figure class="avatar mr-3">
                                                            <span class="avatar-title bg-secondary-bright text-secondary rounded-circle">
                                                                <?php if ($notify->type == 'bank') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                                                <?php }elseif ($notify->type == 'verify' || $notify->type == 'verify_user') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196f3" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"></path></svg>
                                                                <?php }elseif ($notify->type == 'refund') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                                                <?php }elseif ($notify->type == 'with') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                                                <?php }elseif ($notify->type == 'report') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                                                <?php } elseif ($notify->type == 'image') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196f3" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"></path></svg>
                                                                <?php } ?>
                                                            </span>
                                                        </figure>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                            <?php echo $text; ?>
                                                        </p>
                                                        <span class="text-muted small"><?php echo Time_Elapsed_String($notify->created_at); ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                                <?php if ($notify_count > 0) { ?>
                                <div class="px-4 py-3 text-right border-top">
                                    <ul class="list-inline small">
                                        <li class="list-inline-item mb-0">
                                            <a href="javascript:void(0)" onclick="ReadNotify()">Mark All Read</a>
                                        </li>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                <figure class="avatar avatar-sm">
                                    <img src="<?php echo $wo['user']['avatar']; ?>"
                                         class="rounded-circle"
                                         alt="avatar">
                                </figure>
                                <span class="ml-2 d-sm-inline d-none"><?php echo $wo['user']['name']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div class="text-center py-4">
                                    <figure class="avatar avatar-lg mb-3 border-0">
                                        <img src="<?php echo $wo['user']['avatar']; ?>"
                                             class="rounded-circle" alt="image">
                                    </figure>
                                    <h5 class="text-center"><?php echo $wo['user']['name']; ?></h5>
                                    <div class="mb-3 small text-center text-muted"><?php echo $wo['user']['email']; ?></div>
                                    <a href="<?php echo $wo['user']['url']; ?>" class="btn btn-outline-light btn-rounded">View Profile</a>
                                </div>
                                <div class="list-group">
                                    <a href="javascript:void(0)" onclick="logout()" class="list-group-item text-danger">Sign Out!</a>
                                    <?php if ($mode == 'night') { ?>
                                        <a href="javascript:void(0)" class="list-group-item admin_mode" onclick="ChangeMode('day')">
                                            <span id="night-mode-text">Day mode</span>
                                            <svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="javascript:void(0)" class="list-group-item admin_mode" onclick="ChangeMode('night')">
                                            <span id="night-mode-text">Night mode</span>
                                            <svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                                        </a>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item header-toggler">
                    <a href="#" class="nav-link">
                        <i data-feather="arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./ Header -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- begin::navigation -->
        <div class="navigation">
            <div class="navigation-header">
                <span>Navigation</span>
                <a href="#">
                    <i class="ti-close"></i>
                </a>
            </div>
            <div class="navigation-menu-body">
                <ul>
                    <?php //if ($is_admin == true || CheckUserPermission($current_user_id, "dashboard")) { ?>
                    <li>
                        <a <?php echo ($page == 'dashboard') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings(''); ?>" data-ajax="?path=dashboard">
                            <span class="nav-link-icon">
                                <i class="material-icons">dashboard</i>
                            </span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <?php //} ?>
                    <?php
                    if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "general-settings") ||
                            CheckUserPermission($current_user_id, "site-settings") ||
                            CheckUserPermission($current_user_id, "site-features") ||
                            CheckUserPermission($current_user_id, "email-settings") ||
                            CheckUserPermission($current_user_id, "video-settings") ||
                            CheckUserPermission($current_user_id, "live") ||
                            CheckUserPermission($current_user_id, "social-login") ||
                            CheckUserPermission($current_user_id, "payment-settings") ||
                            CheckUserPermission($current_user_id, "amazon-settings")
                        )
                    ) {
                        ?>
                    <li <?php echo ($page == 'general-settings' || $page == 'site-settings' || $page == 'video-settings' || $page == 'email-settings' || $page == 'social-login' || $page == 'site-features' || $page == 'amazon-settings' ||  $page == 'live') ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">settings</i>
                            </span>
                            <span>Settings</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "general-settings")){ ?>
                            <li>
                                <a <?php echo ($page == 'general-settings') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('general-settings'); ?>" data-ajax="?path=general-settings">General Configuration</a>
                            </li>
                            <?php } ?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "site-settings")){ ?>
                            <li>
                                <a <?php echo ($page == 'site-settings') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('site-settings'); ?>" data-ajax="?path=site-settings">Website Information</a>
                            </li>
                            <?php } ?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "site-features")){ ?>
                            <li>
                                <a <?php echo ($page == 'site-features') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('site-features'); ?>" data-ajax="?path=site-features">Manage Site Features</a>
                            </li>
                            <?php } ?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "email-settings")){ ?>
                            <li>
                                <a <?php echo ($page == 'email-settings') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('email-settings'); ?>" data-ajax="?path=email-settings">E-mail & SMS Settings</a>
                            </li>
                            <?php } ?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "video-settings")){ ?>
                            <li>
                                <a <?php echo ($page == 'video-settings') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('video-settings'); ?>" data-ajax="?path=video-settings">Chat & Video/Audio</a>
                            </li>
                            <?php } ?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "social-login")){ ?>
                            <li>
                                <a <?php echo ($page == 'social-login') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('social-login'); ?>" data-ajax="?path=social-login">Social Login Settings</a>
                            </li>
                            <?php } ?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "amazon-settings")){ ?>
                            <li>
                                <a <?php echo ($page == 'amazon-settings') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('amazon-settings'); ?>" data-ajax="?path=amazon-settings">File Upload Configuration</a>
                            </li>
                            <?php } ?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "live")){ ?>
                            <li>
                                <a <?php echo ($page == 'live') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('live'); ?>" data-ajax="?path=live">Setup Live Streaming</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                     <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-languages") ||
                            CheckUserPermission($current_user_id, "add-language") ||
                            CheckUserPermission($current_user_id, "edit-lang")
                        )
                    ) { ?>
                    <li <?php echo ($page == 'manage-languages' || $page == 'add-language' || $page == 'edit-lang') ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">language</i>
                            </span>
                            <span>Languages</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "add-language")) { ?>
                            <li>
                                <a <?php echo ($page == 'add-language') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('add-language'); ?>" data-ajax="?path=add-language">Add New Language & Keys</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-languages")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-languages') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-languages'); ?>" data-ajax="?path=manage-languages">Manage Languages</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-verification-requests") ||
                            CheckUserPermission($current_user_id, "manage-users") ||
                            CheckUserPermission($current_user_id, "affiliates-settings") ||
                            CheckUserPermission($current_user_id, "payment-requests") ||
                            CheckUserPermission($current_user_id, "referrals-list") ||
                            CheckUserPermission($current_user_id, "edit-user-permissions") ||
                            CheckUserPermission($current_user_id, "manage-user-verification") ||
                            CheckUserPermission($current_user_id, "manage-genders") ||
                            CheckUserPermission($current_user_id, "add-genders") ||
                            CheckUserPermission($current_user_id, "edit-genders") ||
                            CheckUserPermission($current_user_id, "manage-profile-fields") ||
                            CheckUserPermission($current_user_id, "add-new-profile-field") ||
                            CheckUserPermission($current_user_id, "edit-profile-field") ||
                            CheckUserPermission($current_user_id, "manage-success-stories") ||
                            CheckUserPermission($current_user_id, "add-success-stories") ||
                            CheckUserPermission($current_user_id, "edit-success-stories") ||
                            CheckUserPermission($current_user_id, "manage-countries") ||
                            CheckUserPermission($current_user_id, "add-countries") ||
                            CheckUserPermission($current_user_id, "edit-countries")
                            
                        )
                    ) { ?>
                    <li <?php echo ($page == 'manage-verification-requests' || $page == 'manage-users' || $page == 'affiliates-settings' || $page == 'payment-requests' || $page == 'referrals-list' || $page == 'edit-user-permissions' || $page == 'manage-user-verification' || $page == 'manage-genders' || $page == 'add-genders' || $page == 'edit-genders' || $page == 'manage-profile-fields' || $page == 'add-new-profile-field' || $page == 'edit-profile-field' || $page == 'manage-success-stories' || $page == 'add-success-stories' || $page == 'edit-success-stories' || $page == 'manage-countries' || $page == 'add-countries' || $page == 'edit-countries') ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">account_circle</i>
                            </span>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "manage-users")){ ?>
                            <li>
                                <a <?php echo ($page == 'manage-users' || $page == 'edit-user-permissions') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-users'); ?>" data-ajax="?path=manage-users">Manage Users</a>
                            </li>
                            <?php }?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "manage-genders")){ ?>
                            <li>
                                <a <?php echo ($page == 'manage-genders' || $page == 'add-genders' || $page == 'edit-genders') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-genders'); ?>" data-ajax="?path=manage-genders">Manage Genders</a>
                            </li>
                            <?php }?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "manage-countries")){ ?>
                                <li>
                                    <a <?php echo ($page == 'manage-countries' || $page == 'add-countries' || $page == 'edit-countries') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-countries'); ?>" data-ajax="?path=manage-countries">Manage Countries</a>
                                </li>
                            <?php }?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "manage-profile-fields")){ ?>
                            <li>
                                <a <?php echo ($page == 'manage-profile-fields' || $page == 'add-new-profile-field' || $page == 'edit-profile-field') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-profile-fields'); ?>" data-ajax="?path=manage-profile-fields">Manage Custom Profile Fields</a>
                            </li>
                            <?php }?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "manage-success-stories")){ ?>
                            <li>
                                <a <?php echo ($page == 'manage-success-stories' || $page == 'add-success-stories' || $page == 'edit-success-stories') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-success-stories'); ?>" data-ajax="?path=manage-success-stories">Manage Success Stories</a>
                            </li>
                            <?php }?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "manage-user-verification")){ ?>
                            <!-- <li>
                                <a <?php echo ($page == 'manage-user-verification') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-user-verification'); ?>" data-ajax="?path=manage-user-verification">Manage Verification</a>
                            </li> -->
                            <?php }?>
                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "manage-verification-requests")){ ?>
                                <li>
                                    <a <?php echo ($page == 'manage-verification-requests') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-verification-requests'); ?>" data-ajax="?path=manage-verification-requests">Manage Verification Requests</a>
                                </li>
                            <?php }?>

                            <?php if($is_admin == true || CheckRadioPermission($current_user_id, "affiliates-settings") || CheckRadioPermission($current_user_id, "payment-requests")){ ?>
                                <li>
                                    <a <?php echo ($page == 'affiliates-settings' || $page == 'payment-requests' || $page == 'referrals-list') ? 'class="open"' : ''; ?> href="javascript:void(0);">Affiliates System</a>
                                    <ul class="ml-menu">
                                        <?php if($is_admin == true || CheckRadioPermission($current_user_id, "affiliates-settings")){ ?>
                                        <li>
                                            <a <?php echo ($page == 'affiliates-settings') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('affiliates-settings'); ?>" data-ajax="?path=affiliates-settings">
                                                <span>Affiliates Settings</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if($is_admin == true || CheckRadioPermission($current_user_id, "payment-requests")){ ?>
                                        <li>
                                            <a <?php echo ($page == 'payment-requests' || $page == 'referrals-list') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('payment-requests'); ?>" data-ajax="?path=payment-requests">
                                                <span>Payment Requests</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "payments") ||
                            CheckUserPermission($current_user_id, "manage-payments") ||
                            CheckUserPermission($current_user_id, "bank-receipts") ||
                            CheckUserPermission($current_user_id, "payment-settings") ||
                            CheckUserPermission($current_user_id, "manage-website-ads") ||
                            CheckUserPermission($current_user_id, "manage-currencies") 
                        )
                    ) { ?>
                    <li <?php echo ( $page == 'manage-payments' || $page == 'payments' || $page == 'bank-receipts' || $page == 'payment-settings' || $page == 'manage-website-ads' || $page == 'manage-currencies') ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">money</i>
                            </span>
                            <span>Payments & Ads</span>
                        </a>
                        <ul class="ml-menu">
							<?php if($is_admin == true || CheckRadioPermission($current_user_id, "payment-settings")){ ?>
                            <li>
                                <a <?php echo ($page == 'payment-settings') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('payment-settings'); ?>" data-ajax="?path=payment-settings">Payment Configuration</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "payments")) { ?>
                            <li>
                                <a <?php echo ($page == 'payments') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('payments'); ?>" data-ajax="?path=payments">Payments</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-payments")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-payments') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-payments'); ?>" data-ajax="?path=manage-payments">Manage Payments</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-currencies")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-currencies') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-currencies'); ?>" data-ajax="?path=manage-currencies">Manage Currencies</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "bank-receipts")) { ?>
                            <li>
                                <a <?php echo ($page == 'bank-receipts') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('bank-receipts'); ?>" data-ajax="?path=bank-receipts">Manage bank receipts</a>
                            </li>
                            <?php } ?>
							<?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-website-ads") ) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-website-ads') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-website-ads'); ?>" data-ajax="?path=manage-website-ads">Manage Website Ads</a>
                            </li>
							<?php }?>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-photos")) { ?>
                    <li <?php echo ($page == 'manage-photos' ) ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">perm_media</i>
                            </span>
                            <span>Photos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a <?php echo ($page == 'manage-photos') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-photos'); ?>" data-ajax="?path=manage-photos">Manage Photos & Videos</a>
                            </li>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-stickers") ||
                            CheckUserPermission($current_user_id, "add-new-sticker")
                        )
                    ) { ?>
                    <li <?php echo ($page == 'manage-stickers' || $page == 'add-new-sticker' ) ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">perm_media</i>
                            </span>
                            <span>Stickers</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-stickers")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-stickers') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-stickers'); ?>" data-ajax="?path=manage-stickers">Manage stickers</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "add-new-sticker")) { ?>
                            <li>
                                <a <?php echo ($page == 'add-new-sticker') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('add-new-sticker'); ?>" data-ajax="?path=add-new-sticker">
                                    Add New sticker
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-articles") ||
                            CheckUserPermission($current_user_id, "manage-blog-categories") ||
                            CheckUserPermission($current_user_id, "add-new-article")
                        )
                    ) { ?>
                    <li <?php echo ($page == 'manage-articles' || $page == 'add-new-article' || $page == 'manage-blog-categories' || $page == 'edit-article') ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">description</i>
                            </span>
                            <span>Blogs</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-articles")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-articles' || $page == 'edit-article') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-articles'); ?>" data-ajax="?path=manage-articles">Manage Blog</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-blog-categories")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-blog-categories') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-blog-categories'); ?>" data-ajax="?path=manage-blog-categories">Blog categories</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "add-new-article")) { ?>
                            <li>
                                <a <?php echo ($page == 'add-new-article') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('add-new-article'); ?>" data-ajax="?path=add-new-article">
                                    Add New article
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-gifts") ||
                            CheckUserPermission($current_user_id, "add-new-gift")
                        )
                    ) { ?>
                    <li <?php echo ($page == 'manage-gifts' || $page == 'add-new-gift' ) ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">perm_media</i>
                            </span>
                            <span>Gifts</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-gifts")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-gifts') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-gifts'); ?>" data-ajax="?path=manage-gifts">Manage gifts</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "add-new-gift")) { ?>
                            <li>
                                <a <?php echo ($page == 'add-new-gift') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('add-new-gift'); ?>" data-ajax="?path=add-new-gift">
                                    Add New Gift
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php }?>

                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-fakechat")
                        )
                    ) { ?>
                    <!-- <li < echo ($page == 'manage-fakechat' ) ? 'class="active"' : ''; ?>>
                        <a  href="< echo Wo_LoadAdminLinkSettings('manage-fakechat'); ?>" data-ajax="?path=manage-fakechat">
                            <span class="nav-link-icon">
                                <i class="material-icons">perm_media</i>
                            </span>
                            <span>Fake User Chat</span>
                        </a>
                     
                    </li> -->

                    <li <?php echo ($page == 'manage-fakechat' ) ? 'class="active"' : ''; ?>>
                        <a  href="https://simplisathi.com/admin-cp/manage-fakechat">
                            <span class="nav-link-icon">
                                <i class="material-icons">perm_media</i>
                            </span>
                            <span>Fake User Chat</span>
                        </a>
                     
                    </li>
                    <?php }?>

                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-themes") ||
                            CheckUserPermission($current_user_id, "change-site-desgin") ||
                            CheckUserPermission($current_user_id, "custom-design")
                        )
                    ) { ?>
                    <li <?php echo ($page == 'manage-themes' || $page == 'change-site-desgin' || $page == 'custom-design') ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">color_lens</i>
                            </span>
                            <span>Design</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-themes")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-themes') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-themes'); ?>" data-ajax="?path=manage-themes">Themes</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "change-site-desgin")) { ?>
                            <li>
                                <a <?php echo ($page == 'change-site-desgin') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('change-site-desgin'); ?>" data-ajax="?path=change-site-desgin">Change Site Design</a>
                            </li>
                            <?php } ?>
                            <!--<li <?php echo ($page == 'custom-design') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo Wo_LoadAdminLinkSettings('custom-design'); ?>">Custom Design</a>
                            </li>-->
                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "fake-users") ||
                            CheckUserPermission($current_user_id, "manage-announcements") ||
                            CheckUserPermission($current_user_id, "ban-users") ||
                            CheckUserPermission($current_user_id, "mock-email") ||
                            CheckUserPermission($current_user_id, "auto-like") ||
                            CheckUserPermission($current_user_id, "manage-invitation") ||
                            CheckUserPermission($current_user_id, "manage-invitation-keys") ||
                            CheckUserPermission($current_user_id, "manage-apps")
                        )
                    ) { ?>
                    <li <?php echo ($page == 'fake-users' || $page == 'manage-announcements' || $page == 'ban-users' || $page == 'mock-email'  || $page == 'auto-like' || $page == "manage-invitation" || $page == "manage-invitation-keys" || $page == "manage-apps" ) ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">build</i>
                            </span>
                            <span>Tools</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "fake-users")) { ?>
                            <li>
                                <a <?php echo ($page == 'fake-users') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('fake-users'); ?>" data-ajax="?path=fake-users">Fake User Generator</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-announcements")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-announcements') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-announcements'); ?>" data-ajax="?path=manage-announcements">Announcements</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "ban-users")) { ?>
                                <li>
                                    <a <?php echo ($page == 'ban-users') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('ban-users'); ?>" data-ajax="?path=ban-users">BlackList</a>
                                </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "mock-email")) { ?>
                                <li>
                                    <a <?php echo ($page == 'mock-email') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('mock-email'); ?>" data-ajax="?path=mock-email">Send E-mail</a>
                                </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-invitation")) { ?>
                                <li>
                                    <a <?php echo ($page == 'manage-invitation') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-invitation'); ?>" data-ajax="?path=manage-invitation">Users Invitation</a>
                                </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-invitation-keys")) { ?>
                                <li>
                                    <a <?php echo ($page == 'manage-invitation-keys') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-invitation-keys'); ?>" data-ajax="?path=manage-invitation-keys">Invitation Codes</a>
                                </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-apps")) { ?>
                                <li>
                                    <a <?php echo ($page == 'manage-apps') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-apps'); ?>" data-ajax="?path=manage-apps">Applications</a>
                                </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "auto-like")) { ?>
                                <li>
                                    <a <?php echo ($page == 'auto-like') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('auto-like'); ?>" data-ajax="?path=auto-like">Auto Like</a>
                                </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage_emails")) { ?>
                                <li>
                                    <a <?php echo ($page == 'manage_emails') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage_emails'); ?>" data-ajax="?path=manage_emails">Manage Emails</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php }?>
                   
                    <?php if ($is_admin == true
                        ||
                        (
                            CheckUserPermission($current_user_id, "manage-custom-pages") ||
                            CheckUserPermission($current_user_id, "edit-terms-pages") ||
                            CheckUserPermission($current_user_id, "pages-seo") ||
                            CheckUserPermission($current_user_id, "manage-faqs") ||
                            CheckUserPermission($current_user_id, "manage_terms_pages")
                        )
                    ) { ?>
                    <li <?php echo ($page == 'edit-terms-pages' || $page == 'manage-custom-pages' || $page == 'add-new-custom-page' || $page == 'edit-custom-page' || $page == 'manage-faqs' || $page == 'manage_terms_pages' ) ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">description</i>
                            </span>
                            <span>Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-custom-pages")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-custom-pages' || $page == 'add-new-custom-page' || $page == 'edit-custom-page') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-custom-pages'); ?>" data-ajax="?path=manage-custom-pages">Manage Custom Pages</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage_terms_pages")) { ?>
                            <li>
                                <a <?php echo ($page == 'manage_terms_pages') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage_terms_pages'); ?>" data-ajax="?path=manage_terms_pages">Manage Terms Pages</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "pages-seo") ) { ?>
                            <li>
                                <a <?php echo ($page == 'pages-seo') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('pages-seo'); ?>" data-ajax="?path=pages-seo">Edit Pages SEO Information</a>
                            </li>
                            <?php } ?>
                            <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-faqs") ) { ?>
                            <li>
                                <a <?php echo ($page == 'manage-faqs') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-faqs'); ?>" data-ajax="?path=manage-faqs">Manage FAQs</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if ($is_admin == true || CheckUserPermission($current_user_id, "manage-reports")) { ?>
                     <li <?php echo ($page == 'manage-reports') ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">warning</i>
                            </span>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a <?php echo ($page == 'manage-reports') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('manage-reports'); ?>" data-ajax="?path=manage-reports">Manage Reports</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if ($is_admin == true || CheckUserPermission($current_user_id, "push-notifications-system") ) { ?>
                    <li <?php echo ( $page == 'push-notifications-system' ) ? 'class="open"' : ''; ?>>
                        <a href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">compare_arrows</i>
                            </span>
                            <span>API Settings</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a <?php echo ($page == 'push-notifications-system') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('push-notifications-system'); ?>" data-ajax="?path=push-notifications-system">Push Notifications Settings</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <a <?php echo ($page == 'system_status') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('system_status'); ?>" data-ajax="?path=system_status">
                            <span class="nav-link-icon">
                                <i class="material-icons">info</i>
                            </span>
                            <span>System Status</span>
                        </a>
                    </li>
                    <?php if ($is_admin == true || CheckUserPermission($current_user_id, "changelog")) { ?>
                    <li>
                        <a <?php echo ($page == 'changelog') ? 'class="active"' : ''; ?> href="<?php echo Wo_LoadAdminLinkSettings('changelog'); ?>" data-ajax="?path=changelog">
                            <span class="nav-link-icon">
                                <i class="material-icons">update</i>
                            </span>
                            <span>Changelogs</span>
                        </a>
                    </li>
                    <li>
                        <a href="http://docs.quickdatescript.com/#faq" target="_blank">
                            <span class="nav-link-icon">
                                <i class="material-icons">more_vert</i>
                            </span>
                            <span>FAQs</span>
                        </a>
                    </li>
                    <?php } ?>
					<a class="pow_link" href="https://codecanyon.net/item/quickdate-the-ultimate-php-dating-platform/23268605" target="_blank">
                        <p>Powered by</p>
                        <img src="https://quickdatescript.com/themes/default/assets/img/logo.png">
                        <b class="badge"><?php echo $wo['config']['version']; ?></b>
                    </a>
                </ul>
            </div>
        </div>
        <!-- end::navigation -->

        <!-- Content body -->
        <div class="content-body">
            <!-- Content -->
            <div class="content ">
                <?php echo $page_loaded; ?>
            </div>
            <!-- ./ Content -->

        </div>
        <!-- ./ Content body -->
    </div>
    <!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->

<script src="<?php echo Wo_LoadAdminLink('vendors/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?php echo(Wo_LoadAdminLink('vendors/select2/js/select2.min.js')) ?>"></script>
    <script src="<?php echo(Wo_LoadAdminLink('assets/js/examples/select2.js')) ?>"></script>
    <script src="<?php echo(Wo_LoadAdminLink('assets/js/app.min.js')) ?>"></script>
    <script type="text/javascript">
        function ChangeMode(mode) {
            if (mode == 'day') {
                $('body').removeClass('dark');
                $('.admin_mode').html('<span id="night-mode-text">Night mode</span><svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>');
                $('.admin_mode').attr('onclick', "ChangeMode('night')");
            }
            else{
                $('body').addClass('dark');
                $('.admin_mode').html('<span id="night-mode-text">Day mode</span><svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>');
                $('.admin_mode').attr('onclick', "ChangeMode('day')");
            }
            hash_id = $('#hash_id').val();
            $.get("<?php echo $wo['site_url']; ?>",{hash_id: hash_id,mode:mode}, function(data) {});
        }
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
            var hash = $('.main_session').val();
              $.ajaxSetup({ 
                data: {
                    hash: hash
                },
                cache: false 
              });
        });
        $('body').on('click', function (e) {
            $('.dropdown-animating').removeClass('show');
            $('.dropdown-menu').removeClass('show');
        });
        function searchInFiles(keyword) {
            if (keyword.length > 2) {
                $.post(Wo_Ajax_Requests_File() + '?f=admin_setting&s=search_in_pages', {keyword: keyword}, function(data, textStatus, xhr) {
                    if (data.html != '') {
                        $('#search_for_bar').html(data.html)
                    }
                    else{
                        $('#search_for_bar').html('')
                    }
                });
            }
            else{
                $('#search_for_bar').html('')
            }
        }
        jQuery(document).ready(function($) {
            jQuery.fn.highlight = function (str, className) {
                if (str != '') {
                    var aTags = document.getElementsByTagName("h2");
                    var bTags = document.getElementsByTagName("label");
                    var cTags = document.getElementsByTagName("h3");
                    var dTags = document.getElementsByTagName("h6");
                    var searchText = str.toLowerCase();

                    if (aTags.length > 0) {
                        for (var i = 0; i < aTags.length; i++) {
                            var tag_text = aTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(aTags[i]).addClass(className)
                            }
                        }
                    }

                    if (bTags.length > 0) {
                        for (var i = 0; i < bTags.length; i++) {
                            var tag_text = bTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(bTags[i]).addClass(className)
                            }
                        }
                    }

                    if (cTags.length > 0) {
                        for (var i = 0; i < cTags.length; i++) {
                            var tag_text = cTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(cTags[i]).addClass(className)
                            }
                        }
                    }

                    if (dTags.length > 0) {
                        for (var i = 0; i < dTags.length; i++) {
                            var tag_text = dTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(dTags[i]).addClass(className)
                            }
                        }
                    }
                }
            };
            jQuery.fn.highlight("<?php echo (!empty($_GET['highlight']) ? $_GET['highlight'] : '') ?>",'highlight_text');
        });
        $(document).on('click', '#search_for_bar a', function(event) {
            event.preventDefault();
            location.href = $(this).attr('href');
        });
        function ReadNotify() {
            hash_id = $('#hash_id').val();
            $.get(Wo_Ajax_Requests_File(),{f:'admin_setting', s:'ReadNotify', hash_id: hash_id});
            location.reload();
        }
        function delay(callback, ms) {
          var timer = 0;
          return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
              callback.apply(context, args);
            }, ms || 0);
          };
        }
        function logout(){
            document.cookie = 'JWT=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;SameSite=None;Secure';
            window.location = "<?php echo($wo['site_url']); ?>";
        }
    </script>

</body>
</html>
