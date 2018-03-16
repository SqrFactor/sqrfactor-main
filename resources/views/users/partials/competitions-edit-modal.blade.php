<!-- Modal -->
<div class="modal fade" id="editNameAndCover" tabindex="-1" role="dialog" aria-labelledby="editNameAndCover"
     {{--aria-hidden="true" data-backdrop="static"--}} data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Update Detail's </h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="title_cover_form">
                <input type="hidden" name="users_competition_slug" id="users_competition_slug"
                       @if(!empty($competition->slug)) value="{{ $competition->slug }}" @endif>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="form-group label-floating">
                                <label class="control-label"> Title </label>
                                <input type="text"
                                       @if(!empty($competition->competition_title)) value="{{ $competition->competition_title }}"
                                       @endif name="competition_title" id="competition_title" class="form-control">
                                <p class="errors  " style="color: red;"></p>


                                </p>
                            </div>


                            <div class="form-group mb-0 is-empty">
                                <input type="text" readonly="" class="form-control open-input-file"
                                       placeholder="Cover Image"
                                       style="background-color: transparent;">
                                <p class="errors " style="color: red;"></p>
                                <input type="file" class="file-upload" name="cover_image" id="cover_image"
                                       style="display: none;">
                                <span class="input-group-addon"><i class="fa fa-paperclip"
                                                                   style="font-size: 18px;"></i></span>
                                <span class="material-input"></span></div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <a class="btn btn-primary title_cover_update">Update</a>
                </div>
            </form>
        </div>
    </div>
</div>
{{--end model--}}

<!-- Modal Brief  -->
<div class="modal fade" id="editBrief" tabindex="-1" role="dialog" aria-labelledby="editBrief"
     {{--aria-hidden="true" data-backdrop="static"--}} data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Update Brief Detail </h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <input type="hidden" name="users_competition_slug" id="users_competition_slug"
                   @if(!empty($competition->slug)) value="{{ $competition->slug }}" @endif>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        {{-- Brief --}}
                        <div class="row form-group">

                            <div class="col-lg-12">
                                <div class="form-group" style="margin-left: -13px;">
                                    <div class="editable medium-editor-insert-plugin"
                                         id="competition_brief"> @if(!empty($competition->brief))  {!! $competition->brief !!} @endif

                                    </div>
                                    <span class="placeholder" style="margin-left: 13px;">
                                        Write a description of competition you want to
                                        launch</span>
                                </div>
                            </div>
                        </div>
                        {{-- /Brief --}}

                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <a class="btn btn-primary brief_update">Update</a>
            </div>

        </div>
    </div>
</div>
{{--end model Brief --}}

<!-- Modal Eligibility Criteria and Awards Other Details  -->
<div class="modal fade" id="eligibilityCriteria_awardstherDetails" tabindex="-1" role="dialog"
     aria-labelledby="eligibilityCriteria_awardstherDetails"
     {{--aria-hidden="true" data-backdrop="static"--}} data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Eligibility Criteria And Awards Other
                    Details </h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <input type="hidden" name="users_competition_slug" id="users_competition_slug"
                   @if(!empty($competition->slug)) value="{{ $competition->slug }}" @endif>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        {{-- Brief --}}
                        <div class="form-group label-floating">
                            <label class="control-label">Eligibility Criteria</label>
                            <input type="text"
                                   @if(!empty($competition->eligibility_criteria)) value="{{ $competition->eligibility_criteria }}"
                                   @endif name="eligibility_criteria" id="eligibility_criteria" class="form-control">
                            <p class="errors  " style="color: red;"></p>


                            </p>
                        </div>

                        <div class="row form-group">

                            <div class="col-lg-12">
                                <div class="form-group" style="margin-left: -13px;">

                                    <div class="editable medium-editor-insert-plugin"
                                         id="honourable_mentions"> @if(!empty($competition->honourable_mentions))  {!! $competition->honourable_mentions !!} @endif

                                    </div>
                                    <span class="placeholder" style="margin-left: 13px;">
                                        Write a description of competition you want to
                                        launch</span>
                                </div>
                            </div>
                        </div>

                        {{-- /Brief --}}

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary eligibilityCriteria_awardstherDetails_update">Update</a>
            </div>

        </div>
    </div>
</div>
{{--end model Eligibility Criteria and Awards Other Details --}}


<!-- Modal Jury  -->
<div class="modal fade" id="editJury" tabindex="-1" role="dialog" aria-labelledby="editBrief"
     {{--aria-hidden="true" data-backdrop="static"--}} data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Update Jury Detail </h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="Jury_update_form">

                <input type="hidden" name="users_competition_slug" id="users_competition_slug"
                       @if(!empty($competition->slug)) value="{{ $competition->slug }}" @endif>

                <div class="modal-body">
                    {{-- Jury --}}
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="radio-inline" style="margin-right: 15px;">
                                    <input type="radio" @if($competition->jury_type == 'no_jury') checked
                                           @endif  name="jury_type" value="no_jury"
                                           style="display: inline;width: auto;"> No Jury
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" @if($competition->jury_type == 'will_update_later') checked
                                           @endif name="jury_type" value="will_update_later"
                                           style="display: inline;width: auto;"> Will Update Later
                                </label>
                            </div>
                            @if(count($competition->userCompetitionJury) > 0)
                                @foreach($competition->userCompetitionJury as $item)
                                    <div class="jury-div form-group jury-div-{{ $loop->index+1 }}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Full Name"
                                                       name="jury_fullname[]"
                                                       @if(!empty($item->jury_fullname)) value="{{ $item->jury_fullname }}" @endif >
                                                <ul class="account-settings ajax_search competitions-jury"></ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group"
                                                       placeholder="Firm/Company/College name"
                                                       @if(!empty($item->jury_firm_company)) value="{{ $item->jury_firm_company }}"
                                                       @endif    name="jury_firm_company[]">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Email address"
                                                       @if(!empty($item->jury_email)) value="{{ $item->jury_email }}"
                                                       @endif
                                                       name="jury_email[]">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Contact number"
                                                       @if(!empty($item->jury_contact)) value="{{ $item->jury_contact }}"
                                                       @endif
                                                       name="jury_contact[]">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="file" name="jury_logo[]">
                                            </div>
                                            <div class="col-sm-6">
                                                @if($loop->first)
                                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                                       id="jury-add-more"><u>Add more +</u></a>
                                                @else

                                                    <a href="javascript:void(0)"
                                                       class="link-inverse form-text mt-3 remove-jury-div"
                                                       data-jury-index="{{ $loop->index+1 }}"><u> Remove -</u></a>

                                                @endif
                                            </div>
                                        </div>

                                        <input type="hidden" name="jury_id[]" value="{{$item->jury_id}}"/>
                                    </div>
                                @endforeach
                            @else
                                <div class="jury-div form-group jury-div-1">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group" placeholder="Full Name"
                                                   name="jury_fullname[]">
                                            <ul class="account-settings ajax_search competitions-jury"></ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group"
                                                   placeholder="Firm/Company/College name"
                                                   name="jury_firm_company[]">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group" placeholder="Email address"
                                                   name="jury_email[]">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group" placeholder="Contact number"
                                                   name="jury_contact[]">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="file" name="jury_logo[]">
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                               id="jury-add-more"><u>Add more +</u></a>
                                        </div>
                                    </div>

                                    <input type="hidden" name="jury_id[]"/>
                                </div>
                            @endif


                        </div>

                    </div>

                    {{-- / Jury --}}
                </div>
                <div class="modal-footer">

                    <a class="btn btn-primary Jury_update">Update</a>
                </div>
            </form>

        </div>
    </div>
</div>
{{--end model Jury --}}


<!-- Modal inAssociationWith  -->
<div class="modal fade" id="inAssociationWith" tabindex="-1" role="dialog" aria-labelledby="inAssociationWith"
     {{--aria-hidden="true" data-backdrop="static"--}} data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> In Association with </h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="InAssociationwith_update_form">

                <input type="hidden" name="users_competition_slug" id="users_competition_slug"
                       @if(!empty($competition->slug)) value="{{ $competition->slug }}" @endif>

                <div class="modal-body">
                    {{-- Partner --}}
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div class="main-partners-div-container form-group">
                                <div class="form-group">
                                    <label class="radio-inline" style="margin-right: 15px;">
                                        <input type="radio" name="partner_type" value="no_partners"
                                               @if($competition->partner_type == 'no_partners') checked @endif
                                               style="display: inline;width: auto;"> No
                                        Partners</label>
                                    <label class="radio-inline">
                                        <input type="radio"
                                               @if($competition->partner_type == 'will_update_later') checked
                                               @endif name="partner_type"
                                               value="will_update_later"
                                               style="display: inline;width: auto;"> Will Update
                                        Later</label>
                                </div>
                                @if(count($competition->userCompetitionPartner) > 0)
                                    @foreach($competition->userCompetitionPartner as $item)
                                        <div class="partners-div-container form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group" placeholder="Name"
                                                           name="partner_name[]"
                                                           @if(!empty($item->partner_name)) value="{{ $item->partner_name  }}" @endif >
                                                    <ul class="account-settings ajax_search competitions-jury competitions-partner"></ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group" placeholder="Website"
                                                           @if(!empty($item->partner_website)) value="{{ $item->partner_website  }}"
                                                           @endif   name="partner_website[]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group"
                                                           placeholder="Email address"
                                                           name="partner_email[]"
                                                           @if(!empty($item->partner_email)) value="{{ $item->partner_email  }}" @endif >
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group"
                                                           placeholder="Contact number"
                                                           name="partner_contact[]"
                                                           @if(!empty($item->partner_contact)) value="{{ $item->partner_contact  }}" @endif >
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-0 is-empty">
                                                        <input type="file" name="partner_logo[]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    @if($loop->first)
                                                        <a href="javascript:void(0)"
                                                           class="link-inverse form-text mt-3"
                                                           id="add-more-partner"><u>Add more +</u></a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                           class="link-inverse form-text mt-3 "><u> Remove -</u></a>
                                                    @endif


                                                </div>
                                            </div>

                                            <input type="hidden" name="partner_id[]" value="{{$item->partner_id}}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="partners-div-container form-group">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Name"
                                                       name="partner_name[]">
                                                <ul class="account-settings ajax_search competitions-jury competitions-partner"></ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Website"
                                                       name="partner_website[]">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group"
                                                       placeholder="Email address"
                                                       name="partner_email[]">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group"
                                                       placeholder="Contact number"
                                                       name="partner_contact[]">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-0 is-empty">
                                                    <input type="file" name="partner_logo[]">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="javascript:void(0)"
                                                   class="link-inverse form-text mt-3"
                                                   id="add-more-partner"><u>Add more +</u></a>
                                            </div>
                                        </div>

                                        <input type="hidden" name="partner_id[]">
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    {{-- / Partner --}}
                </div>
                <div class="modal-footer">

                    <a class="btn btn-primary InAssociationwith_update">Update</a>
                </div>
            </form>

        </div>
    </div>
</div>
{{--end model inAssociationWith --}}



<!-- Modal downloadAttachment  -->
<div class="modal fade" id="downloadAttachment" tabindex="-1" role="dialog" aria-labelledby="downloadAttachment"
     {{--aria-hidden="true" data-backdrop="static"--}} data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Download Attachment </h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="downloadAttachment_form">

                <input type="hidden" name="users_competition_slug" id="users_competition_slug"
                       @if(!empty($competition->slug)) value="{{ $competition->slug }}" @endif>

                <div class="modal-body">
                    {{-- Partner --}}


                    @if(count($competition->userCompetitionAttachment) > 0)

                        @foreach($competition->userCompetitionAttachment as $item)
                            <div class="col-lg-12 remove_row_attachment">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <a target="_blank" href="{{asset($item->attach_documents)}}">View Attachment File</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0)"
                                           class="link-inverse form-text m-0 remove_row_attachment_click" data-attachment_id="{{ $item->id }}" ><u>Remove
                                                  -</u></a>
                                    </div>
                                </div>
                           </div>


                        @endforeach
                            <div class="col-lg-12 attach-documents_append">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-0 is-empty">
                                            <input type="file" name="attach_documents[]">


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0)"
                                           class="link-inverse form-text mt-3 attach-more-documents"><u>Attach
                                                more documents +</u></a>
                                    </div>
                                </div>
                            </div>
                    @else
                    <div class="col-lg-12 attach-documents_append">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-0 is-empty">
                                    <input type="file" name="attach_documents[]">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:void(0)"
                                   class="link-inverse form-text mt-3 attach-more-documents"><u>Attach
                                        more documents +</u></a>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- / Partner --}}
                </div>
                <div class="modal-footer">

                    <a class="btn btn-primary downloadAttachment">Update</a>
                </div>
            </form>

        </div>
    </div>
</div>
{{--end model downloadAttachment --}}



