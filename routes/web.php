<?php

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

/*Route::get('/', function () {
    return view('sqrfactor.home');
})->name('sqrfactor.home')->middleware('guest:web');*/

Route::get('/myallMSG', 'HomeController@getallMSG')->name('myMSG')->middleware('auth:web');
Route::get('/myallMSG/{id}','HomeController@showAllmsg')->middleware('auth:web')->name('chat');
Route::post('/myallMSG/getChat/{id}','HomeController@getChat')->middleware('auth');
Route::post('/myallMSG/sendChat','HomeController@sendChat')->middleware('auth');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest:web');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('guest:web');

Auth::routes();

/*social login*/
Route::get('login/{service}', 'Auth\SocialLoginController@redirect');
Route::get('login/{service}/callback', 'Auth\SocialLoginController@callback');

/*email*/
Route::get('fill-detail', 'Auth\SocialLoginController@needsToFailDetail');

/*user*/
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('activate/token/{token}', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('activate/resend', 'Auth\ActivationController@resend')->name('auth.activate.resend');

/*Route::get('search','User/SearchController@search')->name('search.users');*/


/*ststus post*/

Route::get('news-feed', 'User\NewsFeedController@home')->middleware(['auth:web'])->name('home');

Route::get('results', "User\SearchController@searchResults")->name('SearchResults')->middleware("auth:web");


Route::get('whats-red', 'User\NewsFeedController@whatsRed')->name('whatsRed')->middleware('auth:web');

Route::get("notification", "User\NotificationController@get")->name('notification')->middleware('auth:web');

/*post edit*/ 
Route::get('post/status/edit/{usersPost}', 'User\NewsFeedController@postStatusGet')->name('post.status.edit')->middleware('auth:web');
Route::post('post/status/edit/{usersPost}', 'User\NewsFeedController@postStatusPost')->name('post.status.edit')->middleware('auth:web');

Route::get('post/article/edit/{usersPost}', 'User\NewsFeedController@postArticleGet')->name('post.article.edit')->middleware('auth:web');
Route::post('post/article/edit/{usersPost}', 'User\NewsFeedController@postArticlePost')->name('post.article.edit')->middleware('auth:web');


Route::get('post/design/edit/{usersPost}', 'User\NewsFeedController@postDesignGet')->name('post.design.edit')->middleware('auth:web');
Route::post('post/design/edit/{usersPost}', 'User\NewsFeedController@postDesignPost')->name('post.design.edit')->middleware('auth:web');

// Competition view
Route::group(['prefix' => 'competition'], function () {

    Route::get('/', 'User\CompetitionController@competitionListFindCompetition')->middleware('auth:web')->name('competition.find');

    Route::get('{userCompetition}', 'User\CompetitionController@competitionDetail')->name("competition");

    Route::get('{userCompetition}/wall', 'User\CompetitionController@competitionWall')->middleware('auth:web')->name("competition.wall");
    Route::get('{userCompetition}', 'User\CompetitionController@competitionDetail')->name("competition");

    Route::get("{userCompetition}/submissions", 'User\CompetitionController@competitionSubmission')->middleware('auth:web')->name("competition.submission");


    Route::get("{userCompetition}/results", 'User\CompetitionController@competitionResult')->middleware('auth:web')->name("competition.result");

    Route::get("{userCompetition}/competition-admin", 'User\CompetitionController@competitionAdmin')->middleware('auth:web')->name("competition.competitionadmin");

    Route::get("{userCompetition}/submit-design", 'User\CompetitionController@competitionSubmitDesign')->middleware('auth:web')->name('competition.submit.design');

    Route::get("edit-submit-design/{id}", 'User\CompetitionController@competitionEditSubmitDesign')->middleware('auth:web')->name('competition.submit.design.edit');
});
//Competition close

Route::group(['prefix' => 'post'], function () {
    //Route::get('status','User\StatusPostController@statusPostAdd')->name('statusPOst.add')->middleware('auth:web');

    /*design post*/
    Route::get("design", "User\DesignPostController@designPostAdd")->name('designPost.add')->middleware(['auth:web']);
    Route::post("design", "User\DesignPostController@designPostSave")->name('designPost.add')->middleware('auth:web');

    Route::post("design-parse/", "User\DesignPostController@designPostSaveAjax")->name('designPost.addAjax');

    /*article post*/
    Route::get("article", "User\ArticlePostController@articlePostAdd")->name('articlePost.add')->middleware(['auth:web']);

    Route::post("article", "User\ArticlePostController@articlePostSave")->name('articlePost.add')->middleware('auth:web');

    /*post detail */
    //Route::get("post-detail/{usersPost}", "User\PostDetailController@postDetail")->name('postDetail')->middleware(['auth:web', 'profile_flag']);
    Route::get("post-detail/{usersPost}", "User\PostDetailController@postDetail")->name('postDetail');

    /*competition*/
    Route::get('competition', 'User\CompetitionController@competitionAdd')->name('competitionAdd')->middleware('competitionMiddleware', 'auth:web');

    /*edit competition*/

    /* Route::get('competition-edit/{userCompetition}', 'User\CompetitionController@competitionEdit')->name('competitionEdit')->middleware('competitionMiddleware', 'auth:web');*/


});

Route::get('about/{user}', 'User\AboutProfileController@aboutProfile')->name('aboutProfile');

Route::group(['prefix' => 'profile'], function () {

    Route::get('/', 'HomeController@profile')->name('profile')->middleware(['auth:web']);
    /*Route::get('/detail/{user}','HomeController@viewProfile')->name('profileView')->middleware(['auth:web','profile_flag']);*/

    Route::get('/detail/{user}', 'HomeController@viewProfile')->name('profileView');

    Route::get('/detail/{user}/message', 'HomeController@sendMessage')->name('sendMessage');

   
    Route::get('follow/{user}', 'User\FollowController@following')->name('follow')->middleware('auth:web');

    Route::get('/edit', 'User\UserController@index')->name('profile.edit')->middleware(['auth:web']);

    /*hire-individual-basic-detail*/
    Route::post('edit', 'User\UserController@hireIndividualBasicDetail')->name('hireIndividualBasicDetail.save');

    Route::post('hire-organization-basic-detail', 'User\UserController@hireOrganizationBasicDetail')->name('hireOrganizationBasicDetail.save');

    /*employee-detail*/
    Route::get('add/employee-detail', 'User\UserController@hireOrganizationEmployeeDetail')->name('hire.hireOrganizationEmployeeDetail')->middleware('hireEmployeeDetails', 'hire2');

    Route::post('add/employee-detail', 'User\UserController@hireOrganizationEmployeeDetailSave')->name('hire.hireOrganizationEmployeeDetail');

    /*work individual*/
    Route::post('work-individual-basic-detail', 'User\UserController@workIndividualBasicDetail')->name('work.workIndividualBasicDetail');

    Route::get('edit/education-details', 'User\UserController@workIndividualEducationDetails')->name('work.workIndividualEducationDetails')->middleware('work', 'workEducationDetails');

    Route::post('edit/education-details', 'User\UserController@workIndividualEducationDetailsSave')->name('work.workIndividualEducationDetails');

    Route::get('edit/professional-details', 'User\UserController@workIndividualProfessionalDetails')->name('work.workIndividualProfessionalDetails')->middleware('work', 'workProfessionalDetails');

    Route::get('edit/other-details', 'User\UserController@workIndividualOtherDetails')->name('work.workIndividualOtherDetails')->middleware('work');


    /*work-architecture*/
    Route::post('work-architecture-member-detail', 'User\UserController@architectureBasicDetailSave')->name('work.architectureBasicDetail');
    Route::get('add/member-detail', 'User\UserController@workArchitectureMemberDetail')->name('work.workArchitectureMemberDetail')->middleware('work2', 'workCompanyFirmDetails');

    Route::post('add/member-detail', 'User\UserController@workArchitectureMemberDetailSave')->name('work.workArchitectureMemberDetail');

    Route::get('edit/company-firm-details', 'User\UserController@workArchitectureCompanyFirmDetails')->name('work.workArchitectureCompanyFirmDetails')->middleware('work2', 'workCompanyFirmDetails');
    Route::post('edit/company-firm-details', 'User\UserController@workArchitectureCompanyFirmDetailsSave')->name('work.workArchitectureCompanyFirmDetails');

    Route::get('change-password', 'User\ChangePasswordController@changePasswordAdd')->name('change.password')->middleware('auth:web');
    Route::post('change-password', 'User\ChangePasswordController@changePasswordSave')->name('change.password')->middleware('auth:web');
     
     Route::get('/detail/{user}/user-competition','User\UserController@UserSubmissionList')->name('user-competition')->middleware('auth:web');


});

Route::get("portfolio/{user}", "User\PortfolioController@getPortfolio")->middleware("auth:web")->name("portfolio");

/*parse*/
Route::group(['prefix' => 'parse'], function () {
    /*Chat code*/
    Route::post('getallUsers', 'Parse\SqrFactorController@getallUSERS')->middleware('auth:web');
    Route::post('chnt', 'Parse\SqrFactorController@getCHNT')->middleware('auth:web');
    Route::post('delnotifi', 'Parse\SqrFactorController@delNOTI')->middleware('auth:web');
    Route::post('getnotifi', 'Parse\SqrFactorController@getNOTI')->middleware('auth:web');
    Route::post('getmessages', 'Parse\SqrFactorController@getMSG')->middleware('auth:web');
    Route::post('submit-MSG', 'Parse\SqrFactorController@subMSG')->middleware('auth:web');
    /* /Chat code */

    Route::post('verify-otp', 'Parse\SqrFactorController@verifyOtp')->middleware('auth:web');
    Route::post('resend-otp', 'Parse\SqrFactorController@resendOtp')->middleware('auth:web');

    Route::post('mobile-update', 'Parse\SqrFactorController@mobileUpdate')->middleware('auth:web');

    /*short bio*/
    Route::post("short-bio", "Parse\UserController@short_bio")->middleware('auth:web');

    /*short bio end*/
    Route::post('register', 'Parse\SqrFactorController@register')->middleware('guest:web');
    Route::post('register2', 'Parse\SqrFactorController@register2')->middleware('guest:web');

    Route::post('full-name', 'Parse\SqrFactorController@fullName')->middleware('guest:web');
    Route::post('full-name-auth', 'Parse\UserController@fullNameAuth')->middleware('auth:web');
    Route::post('login', 'Parse\SqrFactorController@login')->middleware('guest:web');

    /*users*/
    Route::post('profile-update', 'Parse\UserController@profileUpdate')->middleware('auth:web');
    Route::post('profile-email-update', 'Parse\UserController@profileEmailUpdate')->middleware('auth:web');

    Route::post('country', 'Parse\UserController@country')->middleware('auth:web');
    Route::post('state', 'Parse\UserController@state')->middleware('auth:web');

    Route::post('remove-attachment', 'Parse\UserController@removeAttachment')->middleware('auth:web');

    /*submission delete route*/

    Route::post('remove-submission', 'User\CompetitionController@submissionDelete')->middleware('auth:web');
    /*Result decalare route*/
    Route::post('award-declare-add', 'User\CompetitionController@competitionAdminResultDeclareSave')->middleware('auth:web');

    /*change profile*/
    Route::post('change-profile', 'Parse\UserController@changeProfile')->middleware('auth:web');

    /* work other detail*/
    Route::post("work-other-detail", "Parse\UserController@workOtherDetail")->middleware('auth:web');
    /* end work other detail*/

    /*work-professional-details*/
    Route::post("work-professional-details", "Parse\UserController@workProfessionalDetails")->middleware('auth:web');
    /*end work-professional-details*/

    /*work-education-detail*/
    Route::post("work-education-detail", "Parse\UserController@workEducationDetail")->middleware('auth:web');
    /*end work-education-detail*/

    Route::post("work-individual-basic", "Parse\UserController@workIndividualBasic")->middleware('auth:web');

    /*add email*/
    Route::post("email-add", "Parse\UserController@emailAdd")->middleware('auth:web');

    /*end add email*/

    Route::post('users-post-like', 'Parse\UserController@usersPostLike')->middleware('auth:web');

    Route::post('submission-post-like', 'Parse\UserController@submissionLike')->middleware('auth:web');
    Route::post('users-comments-like', 'Parse\UserController@usersCommentsLike')->middleware('auth:web');
    /*user submission detail modal */

    Route::post('users-submission-detail', 'Parse\UserController@usersSubmissiondetail')->middleware('auth:web');

    Route::post('users-comment-add', 'Parse\UserController@usersSubmissionAdd')->middleware('auth:web');
    /*user-post-share*/
    Route::post('user-post-share', 'Parse\UserController@userPostShare')->middleware('auth:web');


    /*post view in model*/
    Route::post('post-view', 'Parse\UserController@postView')->middleware('auth:web');

    /*update competition */
    Route::post('title-cover-update', 'Parse\UserController@titleCoverUpdate')->middleware('auth:web');
    Route::post('brief-update', 'Parse\UserController@briefUpdate')->middleware('auth:web');
    Route::post('eligibilityCriteria-awardstherDetails-update', 'Parse\UserController@eligibilityCriteriaAwardstherDetailsUpdate')->middleware('auth:web');
    Route::post('Jury-update', 'Parse\UserController@juryUpdate')->middleware('auth:web');
    Route::post('in-association-with-update', 'Parse\UserController@InAssociationWithUpdate')->middleware('auth:web');

    Route::post('download-attachment', 'Parse\UserController@downloadAttachment')->middleware('auth:web');


    Route::post('/search-follow-friend', 'Parse\UserController@searchFollowFriend')->middleware('auth:web');

    Route::post('/post-status', 'Parse\UserController@postStatus')->middleware('auth:web');


    Route::post("email-add", "Parse\UserController@emailAdd")->middleware('auth:web');
    Route::post("follow", "Parse\UserController@follow")->middleware('auth:web');

    Route::post("like", "Parse\UserController@like")->middleware('auth:web');

    Route::post("like-comment", "Parse\UserController@likeComment")->middleware('auth:web');

    Route::post("comments", "Parse\UserController@comment")->middleware('auth:web');


    Route::post("add-more-email", "Parse\UserController@addEmailMore")->middleware('auth:web');
    Route::post("remove-email", "Parse\UserController@removeEmail")->middleware('auth:web');


    Route::post('college-university', 'Parse\UserController@collegeUniversity')->middleware('auth:web');

    Route::post('company-firm', 'Parse\UserController@companyFirm')->middleware('auth:web');

    Route::post('add-college-company-feed', 'Parse\UserController@addCollegeCompany')->middleware('auth:web');


    /*post*/
    Route::post('post', 'Parse\PostController@postSave')->middleware('auth:web');

    Route::post("design-parse", "User\DesignPostController@designPostSaveAjax")->middleware('auth:web');

    Route::post("design-parse-2", "User\DesignPostController@designPostSaveAjax2")->middleware('auth:web');

    Route::post("design-parse-2-edit", "User\DesignPostController@designPostSaveAjax2Edit")->middleware('auth:web');

    Route::post("article-parse", "User\DesignPostController@articlePostSaveAjax")->middleware('auth:web');

    Route::post("article-edit", "User\DesignPostController@articlePostSaveAjaxEdit")->middleware('auth:web');

    Route::post("post-image-remove", 'Parse\UserController@postImageRemove')->middleware('auth:web');

    Route::post("search", "User\SearchController@searchAjax")->middleware("auth:web");
    

    Route::post("search-msg", "User\SearchController@msg")->middleware("auth:web");

    Route::post("portfolio", "Parse\UserController@addToPortfolio")->middleware("auth:web");

    Route::post("delete-post", "Parse\UserController@deletePost")->middleware("auth:web");

    /*DeletePostCompetition*/
    Route::post("delete-post-competition", "Parse\UserController@DeletePostCompetition")->middleware("auth:web");

    // delete post comment
    Route::post("delete-post-comment", "Parse\UserController@deletePostComment")->middleware("auth:web");


    Route::post("skip-btn", "Parse\UserController@skipBtn")->middleware('auth:web');

    Route::post("invite-friend", "Parse\UserController@inviteFriend")->middleware('auth:web');

    Route::post('profile-social-update', 'Parse\UserController@profileSocialUpdate')->middleware('auth:web');

    Route::post('upload-medium-image', 'Parse\PostController@uploadMediumImage')->middleware('auth:web');

    //get news-feed
    Route::get('news-feed', 'User\NewsFeedController@homeHttp')->middleware(['auth:web']);

    Route::get('whats-red', 'User\NewsFeedController@whatsRedHttp')->middleware(['auth:web']);

    //Competition
    // Submit competition data
    Route::post("competition-save", 'User\CompetitionController@competitionSave')->middleware(['auth:web']);

    Route::post('search/competitions-jury', 'User\CompetitionController@competitionsJurySearch')->middleware('auth:web');
    Route::post('search/participate', 'User\CompetitionController@participateSearch')->middleware('auth:web');
    Route::post('search/competitions-partner', 'User\CompetitionController@competitionsPartnerSearch')->middleware('auth:web');

    Route::post('competition/wall/question/add', 'User\CompetitionController@competitionWallQuestionAdd')->middleware('auth:web');

    Route::post('competition/wall/announcement/add', 'User\CompetitionController@competitionWallAnnouncement')->middleware('auth:web');

    Route::post('competition/wall/question/update', 'User\CompetitionController@competitionWallQuestionUpdate')->middleware('auth:web');

    Route::post('competition/wall/question/delete', 'User\CompetitionController@competitionWallQuestionDelete')->middleware('auth:web');

    Route::post('competition/wall/question/comment/add', 'User\CompetitionController@competitionWallQuestionCommentAdd')->middleware('auth:web');

    Route::post('competition/wall/question/comment/update', 'User\CompetitionController@competitionWallQuestionCommentUpdate')->middleware('auth:web');

    Route::post('competition/wall/question/comment/delete', 'User\CompetitionController@competitionWallQuestionCommentDelete')->middleware('auth:web');

    Route::post('post/participate-data', 'User\CompetitionController@participateAdd')->middleware('auth:web');

    Route::post('competition/participate-check-exist', 'User\CompetitionController@participateCheckExist')->middleware('auth:web');

    Route::post('competition/submission/like', 'User\CompetitionController@competitionSubmissionLike')->middleware('auth:web');

    //Save competition submission design
    Route::post('competition/submission/design-save', 'User\CompetitionController@competitionSubmissionDesignSave')->middleware('auth:web');

    //edit competition submission design
    Route::post('competition/submission/design-edit', 'User\CompetitionController@competitionSubmissionDesignEdit')->middleware('auth:web');

    Route::get('competition/submission/list', 'User\CompetitionController@competitionSubmissionHTTP')->middleware('auth:web');
    Route::post('apply-job', 'User\JobController@applyJob')->middleware('auth:web');

    Route::post('view-applicant', 'User\JobController@viewApplicant')->middleware('auth:web');

    Route::post('apply-event', 'User\EventController@eventApply')->middleware('auth:web');

    Route::post('view-event-user', 'User\EventController@viewEventUser')->middleware('auth:web');
    Route::post('channel','Message\Message@channelCreate')->middleware('auth:web');
});

Route::get('404', function () {
    return view('404');
});

//add follow
Route::post("follow-user", "Parse\SqrFactorController@followUser")->middleware("auth:web");

//
Route::get("profile-picture/{user}", "User\ProfilePictureController@get");
Route::get("profile-name/{user}", "User\ProfilePictureController@getName");

/*admin panel*/
Route::group(['prefix' => 'admin'], function () {

    /*login and logout*/
    Route::get('/', [
        'uses' => 'Admin\LoginController@LoginGet',
        'as' => 'admin-login',
    ]);

    Route::post('/', [
        'uses' => 'Admin\LoginController@loginPost',
        'as' => 'admin-login',
    ]);

    Route::get('logout', [
        'uses' => 'Admin\LoginController@adminLogout',
        'as' => 'admin-logout',
    ]);

    /*dashboard*/
    Route::get('dashboard', [
        'uses' => 'Admin\DashboardController@dashboard',
        'as' => 'admin-dashboard',
    ]);

    Route::get('form', function () {
        return view('admin.form');
    });
    Route::get('table', function () {
        return view('admin.table');
    });
});

//Static pages
Route::get("/tc", "User\StaticPagesController@getTc")->name('tc');

// 404 page error
Route::get('/404', function () {
    return view('404');
})->name('404');


/*event*/
Route::prefix('event')->middleware('auth:web')->group(function () {
    Route::get('add', 'User\EventController@event')->name('eventAdd');
    Route::post('add', 'User\EventController@eventSave')->name('eventAdd');

    Route::get('2/add/{usersEvent}', 'User\EventController@event2')->name('event2Add');
    Route::post('2/add/{usersEvent}', 'User\EventController@event2Save')->name('event2Add');

    Route::get('list', 'User\EventController@eventList')->name('eventList');
    Route::get('{usersEvent}/detail', 'User\EventController@eventDetail')->name('eventDetail');
});


Route::group(['prefix' => 'job'], function () {
    Route::get('/', 'User\JobController@job')->name('job')->middleware('auth:web');
    Route::post('save', 'User\JobController@jobSave')->name('jobAdd')->middleware('auth:web');
    Route::get('list', 'User\JobController@jobList')->name('jobList')->middleware('auth:web');
    Route::get('{userJob}', 'User\JobController@jobDetail')->name('jobDetail')->middleware('auth:web');
});


Route::group(['prefix' => 'message'],function(){
    Route::get('/','Message\Message@index')->name('chat')->middleware('auth:web');
    Route::get('{channel}','Message\Message@viewMessage')->name('viewMessage')->middleware('auth:web');
    Route::post('create','Message\Message@channelCreate')->name('createChannel')->middleware('auth:web');
});

<<<<<<< HEAD
// Route to content generation page

Route::get('/generatecontent', [
        'uses' => 'HomeController@contentGen',
        'as' => 'generate-content',
    ]);
=======

>>>>>>> 0234f62813d32fa720051ebdf62a9344a31b3dee
