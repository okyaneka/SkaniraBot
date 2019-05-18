<div class="card card-profile shadow">
    <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <a href="#">
                    <img src="{{ asset('argon') }}/img/theme/user.png" class="rounded-circle">
                </a>
            </div>
        </div>
    </div>
    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
        <div class="d-flex justify-content-between">
            @if(Request::is('user*'))
            <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary mr-4">{{ __('Kembali') }}</a>
            @endif

            @if (auth()->user()->id == $user->id)
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-default float-right">{{ __('Edit profil') }}</a>
            @endif

            @if (auth()->user()->isAdmin())
            <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-default float-right">{{ __('Edit alumni') }}</a>
            @endif
        </div>
    </div>
    <div class="card-body pt-0 pt-md-4">
        <div class="text-center mt-md-5">
            <h3>
                {{ $user->name }}<span class="font-weight-light">, {{ \Carbon\Carbon::parse($user->dob)->age }} tahun</span>
            </h3>
            <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>{{ __($user->street.', '.$user->address.', '.$user->sub_district.', '.$user->district) }}
            </div>
            <div class="h5">
                <i class="ni business_briefcase-24 mr-2"></i>{{ __('Lulusan tahun '.$user->grad) }}
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Tempat Lahir</div>
                <div class="col text-right">{{ $user->pob }}</div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Tanggal Lahir</div>
                <div class="col text-right">{{ $user->dob }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Jurusan</div>
                <div class="col text-right">{{ \App\Department::where('code',$user->department)->first()->department }}</div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Tahun lulus</div>
                <div class="col text-right">{{ $user->grad }}</div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Status</div>
                <div class="col text-right">{{ \App\Status::where('code',$user->status)->first()->status }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Nomor Telepon</div>
                <div class="col text-right">{{ $user->phone }}</div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Nomor Telegram</div>
                <div class="col text-right">{{ $user->telegram }}</div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Email</div>
                <div class="col text-right"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <div class="col text-left">Link grup telegram</div>
                <div class="col text-right">
                    @isset ($user->group->link)
                    <a href="{!! $user->group->link ?: '#' !!}" target="_blank">{{ substr($user->group->link ,0,25).'...' ?: '-' }}</a>
                    @else
                    <span class="text-muted">Belum terdapat link grup yang terdaftar</span>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>