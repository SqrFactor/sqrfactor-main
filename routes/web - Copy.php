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

Route::get('news-feed', 'User\NewsFeedController@home')->middleware(['auth:web', 'profile_flag'])->name('home');

Route::get('whats-red', 'User\NewsFeedController@whatsRed')->name('whatsRed')->middleware('auth:web');

Route::get("notification","User\NotificationController@get")->name('notification')->middleware('auth:web');

/*post edit*/
Route::get('post/status/edit/{usersPost}','User\NewsFeedController@postStatusGet')->name('post.status.edit')->middleware('auth:web');
Route::post('post/status/edit/{usersPost}','User\NewsFeedController@postStatusPost')->name('post.status.edit')->middleware('auth:web');

Route::get('post/article/edit/{usersPost}','User\NewsFeedController@postArticleGet')->name('post.article.edit')->middleware('auth:web');
Route::post('post/article/edit/{usersPost}','User\NewsFeedController@postArticlePost')->name('post.article.edit')->middleware('auth:web');


Route::get('post/design/edit/{usersPost}','User\NewsFeedController@postDesignGet')->name('post.design.edit')->middleware('auth:web');
Route::post('post/design/edit/{usersPost}','User\NewsFeedController@postDesignPost')->name('post.design.edit')->middleware('auth:web');



Route::group(['prefix' => 'post'], function () {
    //Route::get('status','User\StatusPostController@statusPostAdd')->name('statusPOst.add')->middleware('auth:web');

    /*design post*/
    Route::get("design", "User\DesignPostController@designPostAdd")->name('designPost.add')->middleware(['auth:web', 'profile_flag']);
    Route::post("design", "User\DesignPostController@designPostSave")->name('designPost.add')->middleware('auth:web');

    Route::post("design-parse/", "User\DesignPostController@designPostSaveAjax")->name('designPost.addAjax');

    /*article post*/
    Route::get("article", "User\ArticlePostController@articlePostAdd")->name('articlePost.add')->middleware(['auth:web', 'profile_flag']);
    
    Route::post("article", "User\ArticlePostController@articlePostSave")->name('articlePost.add')->middleware('auth:web');

    /*post detail */
    //Route::get("post-detail/{usersPost}", "User\PostDetailController@postDetail")->name('postDetail')->middleware(['auth:web', 'profile_flag']);
    Route::get("post-detail/{usersPost}", "User\PostDetailController@postDetail")->name('postDetail');

    /*competition*/
    Route::get('competition', 'User\CompetitionController@competitionAdd')->name('competitionAdd')->middleware('competitionMiddleware','auth:web');
    Route::post('competition', 'User\CompetitionController@competitionSave')->name('competitionAdd')->middleware('auth:web');

    Route::get('competition-list', 'User\CompetitionController@competitionList')->name('competitionList')->middleware('competitionMiddleware','auth:web');

    Route::get('competition-detail/{userCompetition}', 'User\CompetitionController@competitionDetail')->name('competitionDetail')->middleware('competitionMiddleware','auth:web');

    Route::get('competition2/{userCompetition}', 'User\CompetitionController@competition2Add')->name('competition2Add')->middleware('competitionMiddleware','auth:web');
    Route::post('competition2/{userCompetition}', 'User\CompetitionController@competition2Save')->name('competition2Add')->middleware('auth:web');

    /*event*/
    Route::get('event', 'User\EventController@event')->name('eventAdd');
    Route::post('event', 'User\EventController@eventSave')->name('eventAdd');
    /*event2*/
    Route::get('event2/{usersEvent}', 'User\EventController@event2')->name('event2Add');
    Route::post('event2/{usersEvent}', 'User\EventController@event2Save')->name('event2Add');

    /*job*/
    Route::get('job', 'User\JobController@job')->name('jobAdd');
    Route::post('job', 'User\JobController@jobSave')->name('jobAdd');
});

Route::get('about/{user}', 'User\AboutProfileController@aboutProfile')->name('aboutProfile');

Route::group(['prefix' => 'profile'], function () {

    Route::get('/', 'HomeController@profile')->name('profile')->middleware(['auth:web', 'profile_flag']);
    /*Route::get('/detail/{user}','HomeController@viewProfile')->name('profileView')->middleware(['auth:web','profile_flag']);*/

    Route::get('/detail/{user}', 'HomeController@viewProfile')->name('profileView');

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

    Route::get('edit/other-details', 'User\UserController@workIndividualOtherDetails')->name('work.workIndividualOtherDetails')->middleware('work', 'profile_flag');

    /*work-architecture*/
    Route::post('work-architecture-member-detail', 'User\UserController@architectureBasicDetailSave')->name('work.architectureBasicDetail');
    Route::get('add/member-detail', 'User\UserController@workArchitectureMemberDetail')->name('work.workArchitectureMemberDetail')->middleware('work2', 'workCompanyFirmDetails');

    Route::post('add/member-detail', 'User\UserController@workArchitectureMemberDetailSave')->name('work.workArchitectureMemberDetail');

    Route::get('edit/company-firm-details', 'User\UserController@workArchitectureCompanyFirmDetails')->name('work.workArchitectureCompanyFirmDetails')->middleware('work2', 'workCompanyFirmDetails');
    Route::post('edit/company-firm-details', 'User\UserController@workArchitectureCompanyFirmDetailsSave')->name('work.workArchitectureCompanyFirmDetails');

    Route::get('change-password', 'User\ChangePasswordController@changePasswordAdd')->name('change.password')->middleware('auth:web', 'profile_flag');
    Route::post('change-password', 'User\ChangePasswordController@changePasswordSave')->name('change.password')->middleware('auth:web');
});

Route::get("portfolio/{user}","User\PortfolioController@getPortfolio")->middleware("auth:web")->name("portfolio");


/*parse*/

Route::group(['prefix' => 'parse'], function () {

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

    /*post view in model*/
    Route::post('post-view', 'Parse\UserController@postView')->middleware('auth:web');

    Route::post('/search-follow-friend', 'Parse\UserController@searchFollowFriend')->middleware('auth:web');

    Route::post('/post-status','Parse\UserController@postStatus')->middleware('auth:web');


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

    Route::post("post-image-remove",'Parse\UserController@postImageRemove')->middleware('auth:web');



    Route::post("search", "User\SearchController@searchAjax")->middleware("auth:web");

    Route::post("portfolio","Parse\UserController@addToPortfolio")->middleware("auth:web");

    Route::post("delete-post","Parse\UserController@deletePost")->middleware("auth:web");

    // delete post comment
    Route::post("delete-post-comment","Parse\UserController@deletePostComment")->middleware("auth:web");

    Route::post("skip-btn","Parse\UserController@skipBtn")->middleware('auth:web');

    Route::post("invite-friend","Parse\UserController@inviteFriend")->middleware('auth:web');

    Route::post('profile-social-update','Parse\UserController@profileSocialUpdate')->middleware('auth:web');

    Route::post('upload-medium-image','Parse\PostController@uploadMediumImage')->middleware('auth:web');

});

Route::get('404', function () {
    return view('404');
});

//add follow
Route::post("follow-user", "Parse\SqrFactorController@followUser")->middleware("auth:web");

//
Route::get("profile-picture/{user}","User\ProfilePictureController@get");

/*admin panel*/
Route::group(['prefix' => 'admin'], function (){

    /*login and logout*/
    Route::get('/',[
        'uses' => 'Admin\LoginController@LoginGet',
        'as' => 'admin-login',
    ]);

    Route::post('/',[
        'uses' => 'Admin\LoginController@loginPost',
        'as' => 'admin-login',
    ]);

    Route::get('logout',[
        'uses' => 'Admin\LoginController@adminLogout',
        'as' => 'admin-logout',
    ]);

    /*dashboard*/
    Route::get('dashboard',[
        'uses' => 'Admin\DashboardController@dashboard',
        'as' => 'admin-dashboard',
    ]);

    Route::get('form', function(){
        return view('admin.form');
    });
    Route::get('table', function(){
        return view('admin.table');
    });
});

//Static pages
Route::get("/tc","User\StaticPagesController@getTc")->name('tc');

// 404 page error
Route::get('/404', function (){
    return view('404');
})->name('404');
