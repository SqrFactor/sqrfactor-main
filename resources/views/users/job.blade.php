@extends('layouts.app-news-feed')

@section('title')  Post-job | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')

    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-10">
                @include('error-message')
                <div class="competition-launch">
                    <h3 class="h3 mb-5">Post job</h3>
                    <form action="{{ route('jobAdd') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Job Title/Position</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label">Job Title</label>
                                    <input type="text" name="job_title" class="form-control" placeholder="" value="{{ old('job_title') }}">
                                    @if ($errors->has('job_title'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('job_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Description</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label">Describe the responsibilities of this position.</label>
                                    <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Jobs category</label>
                            <div class="col-lg-7">
                                <div class="form-group is-select mb-0">
                                    <select class="selectpicker form-control" name="category">
                                        <option value="" selected>Select the category</option>
                                        <option value="Senior Architect" @if(old('category') == 'Senior Architect') selected @endif >Senior Architect</option>
                                        <option value="Junior Architect" @if(old('category') == 'Junior Architect') selected @endif >Junior Architect</option>
                                        <option value="Intern Architect" @if(old('category') == 'Intern Architect') selected @endif >Intern Architect</option>
                                        <option value="Landscape Architect" @if(old('category') == 'Landscape Architect') selected @endif >Landscape Architect</option>
                                        <option value="Urban Designer" @if(old('category') == 'Urban Designer') selected @endif >Urban Designer</option>
                                        <option value="Interior Designer" @if(old('category') == 'Interior Designer') selected @endif >Interior Designer</option>
                                        <option value="BIM Architect" @if(old('category') == 'BIM Architect') selected @endif >BIM Architect</option>
                                         <option value="Architectural 3D Visualizer" @if(old('category') == 'Architectural 3D Visualizer') selected @endif >Architectural 3D Visualizer</option>
                                         <option value="Draftsman" @if(old('category') == 'Draftsman') selected @endif >Draftsman</option>
                                         <option value="Project Manager" @if(old('category') == "Project Manager") selected @endif >Project Manager</option>
                                         <option value="Professor, Guest Faculty" @if(old('category') == 'Professor, Guest Faculty') selected @endif >Professor, Guest Faculty</option>
                                       
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Position type</label>
                            <div class="col-lg-7">
                                <div class="form-group is-select mb-0">
                                    <select class="selectpicker form-control" name="type_of_position">
                                        <option disabled selected>Select the position</option>
                                        <option value="Full time" @if(old('position') == 'Full time') selected @endif>Full time</option>
                                        <option value="Part time" @if(old('position') == 'Part time') selected @endif>Part time</option>
                                         <option value="Internship" @if(old('position') == 'Internship') selected @endif>Internship</option>
                                        
                                    </select>
                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Work experience</label>
                            <div class="col-lg-7">
                                <div class="form-group is-select mb-0">
                                    <select class="selectpicker form-control" name="work_experience">
                                        <option value="" selected>Select work experience</option>
                                        <option value="1_year" @if(old('work_experience') == '1_year') selected @endif>1 year</option>
                                        <option value="2_years" @if(old('work_experience') == '2_years') selected @endif>2 years</option>
                                        <option value="3_years" @if(old('work_experience') == '3_years') selected @endif>3 years</option>
                                        <option value="4_years" @if(old('work_experience') == '4_years') selected @endif>4 years</option>
                                         <option value="5_years" @if(old('work_experience') == '5_years') selected @endif>5 years</option>
                                        <option value="6_years" @if(old('work_experience') == '6_years') selected @endif>6 years</option>
                                        <option value="7_years" @if(old('work_experience') == '7_years') selected @endif>7 years</option>
                                        <option value="8_years" @if(old('work_experience') == '8_years') selected @endif>8 years</option>
                                        <option value="9_years" @if(old('work_experience') == '9_years') selected @endif>9 years</option>
                                        <option value="10_years" @if(old('work_experience') == '10_years') selected @endif>10 years</option>
                                        <option value="11_years" @if(old('work_experience') == '11_years') selected @endif>11 years</option>
                                        <option value="12_years" @if(old('work_experience') == '12_years') selected @endif>12 years</option>
                                        <option value="13_years" @if(old('work_experience') == '13_years') selected @endif>13 years</option>
                                        <option value="14_years" @if(old('work_experience') == '14_years') selected @endif>14 years</option>
                                        <option value="15_years" @if(old('work_experience') == '15_years') selected @endif>15 years</option>
                                    </select>
                                    @if ($errors->has('work_experience'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('work_experience') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Salary</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="Minimum"
                                       name="minimum">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" placeholder="Maximum"
                                       name="maximum">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control selectpicker"
                                        name="salary_type">
                                    <option value="USD">USD</option>
                                    <option value="INR">INR</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group " id="append_job_skills">
                            <label class="col-lg-3 col-form-label h6">Skills</label>
                            <div class="col-lg-7">
                                <input class="form-control" name="skills[]" placeholder="Add skills you are looking for" type="text">

                            </div>
                            <div class="col-lg-2">
                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 add_job_skills"><u>Add more +</u></a>
                            </div>
                        </div>

                        <div class="row form-group" id="append_educational_eualification">
                            <label class="col-lg-3 col-form-label h6">Educational Qualification</label>
                            <div class="col-lg-7">
                                <input class="form-control" placeholder="Add qualification" type="text" name="educational_qualification[]">

                            </div>
                            <div class="col-lg-2">
                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 add_educational_qualification"><u>Add more +</u></a>
                            </div>
                        </div>
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Firm</label>
                            <div class="col-lg-7">
                                <input class="form-control" placeholder="Firm - Sqr factor India PVT LTD" type="text" value="{{Auth::user()->userDetail->firm_or_company_name}}" name="firm">
                                @if ($errors->has('firm'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('firm') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Location</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label">Country</label>
                                    <select class="selectpicker form-control" name="country" data-live-search="true">
                                        <option selected disabled> Select Country</option>
                                        @if($countries->count())
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" >{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group label-floating is-select">
                                    <label class="control-label">State/Province</label>
                                    <select class="selectpicker form-control state" data-live-search="true" name="state">
                                    </select>
                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group label-floating is-select">
                                    <label class="control-label">City</label>
                                    <select class="selectpicker form-control city  fghfghfghf" name="city" data-live-search="true">
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Job offer expires on</label>
                            <div class="col-lg-7">
                                <div class="form-group date-time-picker mb-0">
                                    <input type="text" name="datetimepicker" value=""  />
                                    @if ($errors->has('datetimepicker'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('datetimepicker') }}</strong>
                                        </span>
                                    @endif
                                    <span class="input-group-addon">
                                    <svg class="olymp-month-calendar-icon icon"><use xlink:href="../assets/icons/icons.svg#olymp-month-calendar-icon"></use></svg>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-lg-12 offset-lg-3">
                                <button type="submit" class="btn btn-primary btn-submit">Post Job</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection