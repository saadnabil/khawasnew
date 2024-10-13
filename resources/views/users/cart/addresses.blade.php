@php
use App\Models\Address; // Import the Address class

$address = Address::where('user_id', auth()->user()->id)->latest()->get(); // Fetch addresses for the authenticated user
@endphp

@php
$forcount = 0;
@endphp
@foreach ($address as $key => $add)
<div class="form-check">
    <input required class="form-check-input" type="radio" name="address_id" value="{{ $add->id }}" id="flexRadioDefault{{ $forcount }}">
    <label style="font-weight:bold;" class="form-check-label text-primary" for="flexRadioDefault{{ $forcount }}">
        {{ $add->label }}
    </label>
    <p class="mb-1 mt-2">{{ $add->address }}</p>

    <p class="mb-1"><span class="text-warning">Country</span>:
        {{ $add->country->name ?? 'N/A' }}

        <p class="mb-1"><span class="text-warning">{{ __('translation.City') }}</span>:
            {{ $add->city->name ?? 'N/A' }}


            <p class="mb-1"><span class="text-warning">{{ __('translation.State') }}</span>:
                {{ $add->state->name ?? 'N/A' }}


                <p class="mb-1"><span class="text-warning">{{ __('translation.Zip') }}</span>:
                    {{ $add->zip }}</p>


                @if(count($address) > 1)
                <a onclick="" data-route="{{ route('user.addresses.destroy', $add) }}" class="btn btn-primary btn-icon mt-3 deleteaddress">
                    <i class="ri bi-trash-fill"></i>
                </a>
                @endif
</div>
<hr>
@php
$forcount += 1;
@endphp

@endforeach
