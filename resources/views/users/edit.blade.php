@extends('layouts.app', ['title' => __('User Management')])

@section('content')
@include('users.partials.header', ['title' => __('Edit User')])

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-xl-6 offset-xl-3 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('User Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.update', $user) }}" autocomplete="off">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Nama') }}</label>
                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Nama') }}" value="{{ old('name', $user->name) }}" required>                                @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                            <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>                                @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> @endif
                        </div>
                        <hr>
                        <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-street">{{ __('Alamat') }}</label>
                            <input type="text" name="street" id="input-street" class="form-control form-control-alternative {{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" value="{{ old('street',  $user->street) }}" required>
                            <small class="form-text text-muted">
                                Jalan / Dusun / RT / RW
                            </small>
                            @if ($errors->has('street'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('street') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-address">{{ __('Desa') }}</label>
                            <input type="text" name="address" id="input-address" class="form-control form-control-alternative {{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Desa') }}" value="{{ old('address',   $user->address) }}" required>
                            <small class="form-text text-muted">
                                Desa / Kelurahan
                            </small>
                            @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('sub_district') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-sub_district">{{ __('Kecamatan') }}</label>
                            <input type="text" name="sub_district" id="input-sub_district" class="form-control form-control-alternative {{ $errors->has('sub_district') ? ' is-invalid' : '' }}" placeholder="{{ __('Kecamatan') }}" value="{{ old('sub_district',   $user->sub_district) }}" required>
                            @if ($errors->has('sub_district'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sub_district') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('district') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-district">{{ __('Kabupaten') }}</label>
                            <input type="text" name="district" id="input-district" class="form-control form-control-alternative {{ $errors->has('district') ? ' is-invalid' : '' }}" placeholder="{{ __('Kabupaten') }}" value="{{ old('district', $user->district) }}" required>
                            @if ($errors->has('district'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('district') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <hr>
                        <div class="form-group{{ $errors->has('pob') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-pob">{{ __('Tempat Lahir') }}</label>
                            <input type="text" name="pob" id="input-pob" class="form-control form-control-alternative {{ $errors->has('pob') ? ' is-invalid' : '' }}" placeholder="{{ __('Tempat Lahir') }}" value="{{ old('pob', $user->pob) }}" required>
                            @if ($errors->has('pob'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pob') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('dob') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-dob">{{ __('Tanggal Lahir') }}</label>
                            <input type="date" name="dob" id="input-dob" class="form-control form-control-alternative {{ $errors->has('dob') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal Lahir') }}" value="{{ old('dob', $user->dob) }}" required>
                            @if ($errors->has('dob'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <hr>
                        <div class="form-group{{ $errors->has('department') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-department">{{ __('Jurusan') }}</label>
                            <select name="department" id="input-department" class="form-control form-control-alternative {{ $errors->has('department') ? ' is-invalid' : '' }}" {{ empty($departments) ? 'disabled' : '' }}>
                                @foreach ($departments as $department)
                                <option {{ $user->department == $department->code ? 'selected' : '' }} value="{{ $department->code }}">{{ $department->department }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('department'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('department') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('grad') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-grad">{{ __('Tahun Lulus') }}</label>
                            <input type="text" name="grad" id="input-grad" class="form-control form-control-alternative {{ $errors->has('grad') ? ' is-invalid' : '' }}" placeholder="{{ __('Tahun Lulus') }}" value="{{ old('grad', $user->grad) }}" required>

                            @if ($errors->has('grad'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('grad') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                            <select name="status" id="input-status" class="form-control form-control-alternative {{ $errors->has('status') ? ' is-invalid' : '' }}" {{ empty($statuses) ? 'disabled' : '' }}>
                                @foreach ($statuses as $status)
                                <option {{ $user->status == $status->code ? 'selected' : '' }} value="{{ $status->code }}">{{ $status->status }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('status'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <hr>
                        <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-phone">{{ __('Nomor Handphone') }}</label>
                            <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative {{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Nomor Handphone') }}" value="{{ old('phone', $user->phone) }}" required>
                            @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span> 
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('telegram') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-telegram">{{ __('Nomor Telegram') }}</label>
                            <input type="text" name="telegram" id="input-telegram" class="form-control form-control-alternative {{ $errors->has('telegram') ? ' is-invalid' : '' }}" placeholder="{{ __('Nomor Telegram') }}" value="{{ old('telegram', $user->telegram) }}" required>
                            @if ($errors->has('telegram'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('telegram') }}</strong>
                            </span> 
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
