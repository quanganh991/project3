<?php

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
Route::get('/','UserController\HomeController@home');
Route::get('/home','UserController\HomeController@home');
Route::get('/home-admin','AdminController\HomeController@welcomeAdmin');
Route::get('/home-journalist','JournalistController\HomeController@welcomeJournalist');
//đăng nhập, đăng ký
Route::get('/login','LoginController@login');
Route::get('/login-check','LoginController@login_check');
Route::get('/signup','LoginController@signup');
Route::get('/signup-check','LoginController@signup_check');
Route::get('/logout','LoginController@logout');
//xem chi tiết 1 tin, xem các tin theo branch,, tìm kiếm title theo từ khóa
Route::get('/branch-result-{id_main}','UserController\CategoryController@ViewBranchList');
Route::get('/news-result-{id_branch}','UserController\CategoryController@ViewNewsList');//
Route::get('/news-detail-{id_news}','UserController\CategoryController@ViewNewsDetail');
//thay đổi thông tin cá nhân người dùng
Route::get('/change-user-information','UserController\UserInformationController@changeUserInformation');
Route::get('/alter-user-information','UserController\UserInformationController@alterUserInformation');
//Lưu, bỏ lưu bài viết
Route::get('/bookmark','UserController\CategoryController@bookmark');
Route::get('/unbookmark','UserController\CategoryController@unbookmark');
Route::get('/unbookmark-{id_news}','UserController\CategoryController@unbookmark2');
//Xem các bài viết mình đã lưu
Route::get('/view-all-user-bookmark','UserController\CategoryController@viewAllUserBookmark');
//Xem tất cả bình luận của mình
Route::get('/view-all-user-comment','UserController\CommentController@viewAllUserComment');
//Kiểm tra trắc nghiệm
Route::get('/check-multiple-choice','UserController\MultipleChoiceController@checkMultipleChoice');
//Góc nhìn
Route::get('/all-goc-nhin','UserController\GocNhinController@allGocNhin');
Route::get('/goc-nhin-tac-gia-{id_customer}','UserController\GocNhinController@gocNhinTacGia');
Route::get('/detail-goc-nhin-{id_gocnhin}','UserController\GocNhinController@detailGocNhin');
Route::post('/up-gocnhin','UserController\GocNhinController@upGocNhin');
Route::get('/user-control-goc-nhin','UserController\GocNhinController@userControlGocNhin');
//người dùng quản lý sự kiện, trận đấu mà mình đã tham gia
Route::get('/user-control-tournament','UserController\TournamentController@viewAllTournament');
Route::get('/user-control-event','UserController\TournamentController@viewAllEvent');
Route::get('/cancel-participant-{id_participant}','UserController\TournamentController@cancelParticipant');
//Giao diện trận đấu/sự kiện riêng
Route::get('/detail-tournament-{id_tournament}','UserController\TournamentController@detailTournament');//ok    //chức năng xem chi tiết
Route::get('/comming-soon-tournament','UserController\TournamentController@commingSoonTournament');//ok //chức năng sự kiện sắp diễn ra
Route::get('/champion-list','UserController\TournamentController@championList');//ok    //chức năng danh sách quán quân, á quân
Route::get('/all-tournament-by-team-{team_name}','UserController\TournamentController@allTournamentByTeam');//ok    //chức năng tìm kiếm
Route::get('/search-tournament-by-team','UserController\TournamentController@searchTournamentByTeam');//ok  //chức năng tìm kiếm
Route::get('/register-for-tournament-{id_tournament}','UserController\TournamentController@registerForTournament'); //đăng ký tham gia sự kiện
Route::get('/submit-register','UserController\TournamentController@submitRegister');
Route::get('/predict-tournament','UserController\TournamentController@predictTournament');//Dự đoán tỉ số
//Tìm kiếm bài viết
Route::get('/search-news','UserController\CategoryController@searchNews');
//notification
Route::get('/user-view-notification','UserController\NotificationController@viewAllNotification');
Route::get('/mark-as-read-notification-{id_notification}','UserController\NotificationController@markAsReadNotification');

//Admin
//Xem tất cả Session
Route::get('/view-all-session','AdminController\SessionController@viewAllSession');
//welcome admin
Route::get('/welcome-admin','AdminController\HomeController@welcomeAdmin');
//Thêm tin tức News, Branch, Main
Route::get('/add-branch-category','AdminController\NewsController@addBranchCategory');
Route::get('/save-branch-category','AdminController\NewsController@saveBranchCategory');

Route::get('/add-main-category','AdminController\NewsController@addMainCategory');
Route::get('/save-main-category','AdminController\NewsController@saveMainCategory');

Route::get('/add-news','AdminController\NewsController@addNews');
Route::post('/save-news','AdminController\NewsController@saveNews');
//sửa branch
Route::get('/all-branch-category','AdminController\NewsController@showAllBranchCategory');
Route::get('/edit-branch-category/{id_branch_category}','AdminController\NewsController@editBranchCategory');
Route::get('/submit-edit-branch','AdminController\NewsController@submitEditBranch');
//sửa main
Route::get('/all-main-category','AdminController\NewsController@showAllMainCategory');
Route::get('/edit-main-category/{id_main}','AdminController\NewsController@editMainCategory');
Route::get('/submit-edit-main','AdminController\NewsController@submitEditMain');
//sửa, xóa tin tức
Route::get('/all-news','AdminController\NewsController@showAllNews');
Route::get('/unactive-news/{id_news}','AdminController\NewsController@unactiveNews');
Route::get('/active-news/{id_news}','AdminController\NewsController@activeNews');
Route::get('/edit-news/{id_news}','AdminController\NewsController@editNews');
Route::post('/submit-edit-news','AdminController\NewsController@submitEditNews');
//thêm, sửa, xóa trắc nghiệm
Route::get('/add-multiple-choice','AdminController\MultipleChoiceController@addMultipleChoice');
Route::post('/save-multiple-choice','AdminController\MultipleChoiceController@saveMultipleChoice');
Route::get('/all-multiple-choice','AdminController\MultipleChoiceController@showAllMultipleChoice');
Route::get('/unactive-multiple-choice/{id_multiple-choice}','AdminController\MultipleChoiceController@unactiveMultipleChoice');
Route::get('/active-multiple-choice/{id_multiple-choice}','AdminController\MultipleChoiceController@activeMultipleChoice');
Route::get('/edit-multiple-choice/{id_multiple_choice}','AdminController\MultipleChoiceController@editMultipleChoice');
Route::post('/submit-edit-multiple-choice','AdminController\MultipleChoiceController@submitEditMultipleChoice');
//quản lý giải đấu, sự kiện
Route::get('/all-tournament','AdminController\TournamentController@allTournament');
Route::get('/edit-tournament/{id_tournament}','AdminController\TournamentController@editTournament');
Route::post('/submit-edit-tournament','AdminController\TournamentController@submitEditTournament');
Route::post('/save-tournament','AdminController\TournamentController@saveTournament');
//Xem danh sách người tham gia sự kiện
Route::get('/all-participant-{id_tournament}','AdminController\TournamentController@viewAllParticipant');
Route::get('/approve-participant-{id_participant}','AdminController\TournamentController@approveParticipant');
Route::get('/deny-participant-{id_participant}','AdminController\TournamentController@denyParticipant');
//xem danh sách những người đã bình chọn
Route::get('/view-all-prediction','AdminController\TournamentController@viewAllPrediction');


//quản lý người dùng
//hiển thị danh sách người dùng
Route::get('/display-user','AdminController\PeopleController@displayUser');
//block người dùng
Route::get('/block-user/{id_customer}','AdminController\PeopleController@blockUser');
Route::get('/unblock-user/{id_customer}','AdminController\PeopleController@unBlockUser');
//xóa bình luận
Route::get('/delete-comment/{id_comment}','AdminController\PeopleController@deleteComment');
Route::get('/delete-reply/{id_reply}','AdminController\PeopleController@deleteReply');

//thay đổi thông tin cá nhân admin
Route::get('/change-admin-information','AdminController\AdminInformationController@changeAdminInformation');
Route::get('/alter-admin-information','AdminController\AdminInformationController@alterAdminInformation');
//thêm admin
Route::get('/add-admin','AdminController\AdminInformationController@addAdmin');
Route::get('/save-admin','AdminController\AdminInformationController@saveAdmin');
//Xem tất cả bình luận và phản hồi của người dùng
Route::get('/admin-view-all-user-comment','AdminController\PeopleController@commentController');
//xem tất cả góc nhìn của người dùng
Route::get('/admin-view-all-user-gocnhin','AdminController\GocNhinController@viewAllUserGocNhin');
Route::get('/unactive-gocnhin/{id_gocnhin}','AdminController\GocNhinController@unactiveGocNhin');
Route::get('/active-gocnhin/{id_gocnhin}','AdminController\GocNhinController@activeGocNhin');
Route::get('/unmakeHot-gocnhin/{id_gocnhin}','AdminController\GocNhinController@unmakeHotGocNhin');
Route::get('/makeHot-gocnhin/{id_gocnhin}','AdminController\GocNhinController@makeHotGocNhin');
Route::get('/approve-user-gocnhin-{id_gocnhin}','AdminController\GocNhinController@approveUserGocnhin');


//Phía Journalist
//welcome journalist
Route::get('/welcome-journalist','JournalistController\HomeController@welcomeJournalist');
//quản lý tin tức
Route::get('/jnl-all-news','JournalistController\NewsController@showAllNews');
Route::get('/jnl-unactive-news/{id_news}','JournalistController\NewsController@unactiveNews');
Route::get('/jnl-active-news/{id_news}','JournalistController\NewsController@activeNews');
Route::get('/jnl-edit-news/{id_news}','JournalistController\NewsController@editNews');
Route::post('/jnl-submit-edit-news','JournalistController\NewsController@submitEditNews');
Route::post('/jnl-save-news','JournalistController\NewsController@saveNews');
//thay đổi thông tin cá nhân nhà báo
Route::get('/change-journalist-information','JournalistController\JournalistInformationController@changeJournalistInformation');
Route::get('/alter-journalist-information','JournalistController\JournalistInformationController@alterJournalistInformation');
//thêm, sửa, xóa trắc nghiệm
Route::get('/jnl-add-multiple-choice','JournalistController\MultipleChoiceController@addMultipleChoice');
Route::post('/jnl-save-multiple-choice','JournalistController\MultipleChoiceController@saveMultipleChoice');
Route::get('/jnl-all-multiple-choice','JournalistController\MultipleChoiceController@showAllMultipleChoice');
Route::get('/jnl-unactive-multiple-choice/{id_multiple-choice}','JournalistController\MultipleChoiceController@unactiveMultipleChoice');
Route::get('/jnl-active-multiple-choice/{id_multiple-choice}','JournalistController\MultipleChoiceController@activeMultipleChoice');
Route::get('/jnl-edit-multiple-choice/{id_multiple_choice}','JournalistController\MultipleChoiceController@editMultipleChoice');
Route::post('/jnl-submit-edit-multiple-choice','JournalistController\MultipleChoiceController@submitEditMultipleChoice');


//Chung cho cả 3
//comment
Route::get('/comment','CommentController@comment');
Route::get('/reply','CommentController@reply');
