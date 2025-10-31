@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Section Customization') }}</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Pages') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Home Page') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Section Customization') }}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="" action="{{ route('admin.sections.update') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card-title">{{ __('Customize Sections') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-5 pb-5">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                @csrf

                                <div class="form-group">
                                    <label>{{ __('Hero Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="hero_section" value="1"
                                                class="selectgroup-input" {{ $abs->hero_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="hero_section" value="0"
                                                class="selectgroup-input" {{ $abs->hero_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Work Process Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="work_process_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->work_process_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="work_process_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->work_process_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Featured User Section') }} **</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="featured_users_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->featured_users_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="featured_users_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->featured_users_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Intro Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="intro_section" value="1"
                                                class="selectgroup-input" {{ $abs->intro_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="intro_section" value="0"
                                                class="selectgroup-input" {{ $abs->intro_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Template Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="template_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->template_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="template_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->template_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Pricing Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="pricing_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->pricing_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="pricing_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->pricing_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Partners Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="partners_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->partners_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="partners_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->partners_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Testimonial Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="testimonial_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->testimonial_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="testimonial_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->testimonial_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Blog Section') }} <span class="text-danger">{{ '*' }}</span>
                                    </label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="blog_section" value="1"
                                                class="selectgroup-input" {{ $abs->blog_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="blog_section" value="0"
                                                class="selectgroup-input" {{ $abs->blog_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Top Footer Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="top_footer_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->top_footer_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="top_footer_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->top_footer_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Copyright Section') }} <span
                                            class="text-danger">{{ '*' }}</span></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="copyright_section" value="1"
                                                class="selectgroup-input"
                                                {{ $abs->copyright_section == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="copyright_section" value="0"
                                                class="selectgroup-input"
                                                {{ $abs->copyright_section == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                </div>

                                @if (count($additional_section_statuses) > 0)
                                    @foreach ($additional_section_statuses as $key => $additional_section_status)
                                        @php
                                            $section_content = App\Models\AdditionalSectionContent::where([
                                                ['language_id', $languge_id],
                                                ['addition_section_id', $key],
                                            ])->first();
                                        @endphp


                                        @if ($section_content)
                                            <div class="form-group">
                                                <label>{{ $section_content->section_name . ' ' . __('Section') }} <span
                                                        class="text-danger">{{ '*' }}</span> </label>
                                                <div class="selectgroup w-100">
                                                    <label class="selectgroup-item">
                                                        <input type="radio"
                                                            name="additional_sections[{{ $key }}]"
                                                            value="1" class="selectgroup-input"
                                                            {{ $additional_section_status == 1 ? 'checked' : '' }}>
                                                        <span class="selectgroup-button">{{ __('Active') }}</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio"
                                                            name="additional_sections[{{ $key }}]"
                                                            value="0" class="selectgroup-input"
                                                            {{ $additional_section_status == 0 ? 'checked' : '' }}>
                                                        <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form">
                            <div class="form-group from-show-notify row">
                                <div class="col-12 text-center">
                                    <button type="submit" id="displayNotif"
                                        class="btn btn-success">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
