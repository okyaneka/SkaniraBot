<div class="card card-profile shadow">
    <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <a href="#">
                    <img src="{{ asset('storage/avatars/'.auth()->user()->avatar) }}" class="rounded-circle">
                </a>
            </div>
        </div>
    </div>

    <div class="card-body pt-0 pt-md-4 pb-5">

        <div class="text-center mt-md-7">
            <h3>
                {{ auth()->user()->name }}
                @empty ( !auth()->user()->dob )
                <span class="font-weight-light">, {{ \Carbon\Carbon::parse(auth()->user()->dob)->age }} tahun</span>
                @endempty
            </h3>
            <div class="h5 font-weight-300">
                <i class="ni ni-pin-3 mr-2"></i>
                @empty ( !auth()->user()->street )
                <span>{{ auth()->user()->street }},</span>
                @endempty
                @empty ( !auth()->user()->address )
                <span>{{ auth()->user()->getAddress() }},</span>
                @endempty
                @empty ( !auth()->user()->sub_district )
                <span>{{ auth()->user()->getSubDistricts() }},</span>
                @endempty
                @empty ( !auth()->user()->district )
                <span>{{ auth()->user()->getDistricts() }},</span>
                @endempty
                @empty ( !auth()->user()->province )
                <span>{{ auth()->user()->getProvinces() }}</span>
                @endempty
            </div>
            <div class="h5">
                <span>
                    @empty ( !auth()->user()->grad )
                    Lulusan tahun {{ __(auth()->user()->grad) }} 
                    @endempty
                    @empty ( !auth()->user()->department )
                    jurusan {{ auth()->user()->department }}
                    @endempty
                </span>
            </div>
            @empty ( !auth()->user()->group )
            <hr>
            <div class="h4"><span class="font-weight-light">Link grup telegram : </span><a href="{{ auth()->user()->group->link }}" target="_blank">{{ auth()->user()->group->link }}</a></div>
            @endempty
        </div>
    </div>
</div>