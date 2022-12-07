@extends('marketplace::shop.layouts.account')

@section('page_title')
    {{ __('marketplace_fedex::app.shop.sellers.fedex.manage-configuration') }}
@endsection

@section('content')
    <?php
        if (app('Webkul\Marketplace\Repositories\SellerRepository')->isSeller(auth()->guard('customer')->user()->id)) {
            $customerId = auth()->guard('customer')->user()->id;

            $sellerId = app('Webkul\Marketplace\Repositories\SellerRepository')->findOneWhere(['customer_id'=> $customerId]);

            $sellerId = $sellerId->id;
        }

    ?>

    <div class="account-layout">

        <form method="post" action="{{ route('marketplacefedex.credentials.store', $sellerId) }}" enctype="multipart/form-data">
            <div class="account-head seller-profile-edit mb-10">

                <span class="account-heading">{{ __('marketplace_fedex::app.shop.sellers.fedex.manage-configuration') }}</span>

                <div class="account-action">

                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('marketplace::app.shop.sellers.account.profile.save-btn-title') }}
                    </button>

                </div>

                <div class="horizontal-rule"></div>

            </div>

            <div class="account-table-content">

                @csrf()

                <accordian :title="'{{ __('marketplace_fedex::app.shop.sellers.fedex.fedex-config') }}'" :active="true">
                    <div slot="body">
                        <div class="control-group" :class="[errors.has('account_id') ? 'has-error' : '']">
                            <label for="text" class="required">{{ __('marketplace_fedex::app.shop.sellers.fedex.account-id') }}<i class="export-icon"></i> </label>
                            <input type="text" v-validate="'required'" class="control" name="account_id" value="{{ $credentials->account_id ?? ''}}" data-vv-as="&quot;{{ __('marketplace_fedex::app.shop.sellers.fedex.account-id') }}&quot;">
                            <span class="control-error" v-if="errors.has('account_id')">@{{ errors.first('account_id') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="text" class="required">{{ __('marketplace_fedex::app.shop.sellers.fedex.password') }}<i class="export-icon"></i> </label>
                            <input type="password" v-validate="'required'" class="control" name="password" value="{{$credentials->password ?? ''}}" data-vv-as="&quot;{{ __('marketplace_fedex::app.shop.sellers.fedex.password') }}&quot;">
                            <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('meter_number') ? 'has-error' : '']">
                            <label for="text" class="required">{{ __('marketplace_fedex::app.shop.sellers.fedex.meter-number') }}<i class="export-icon"></i> </label>
                            <input type="password" v-validate="'required'" class="control" name="meter_number" value="{{$credentials->meter_number ?? ''}}" data-vv-as="&quot;{{ __('marketplace_fedex::app.shop.sellers.fedex.meter-number') }}&quot;">
                            <span class="control-error" v-if="errors.has('meter_number')">@{{ errors.first('meter_number') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('key') ? 'has-error' : '']">
                            <label for="text" class="required">{{ __('marketplace_fedex::app.shop.sellers.fedex.key') }}<i class="export-icon"></i> </label>
                            <input type="password" v-validate="'required'" class="control" name="key" value="{{$credentials->key ?? ''}}" data-vv-as="&quot;{{ __('marketplace_fedex::app.shop.sellers.fedex.key') }}&quot;">
                            <span class="control-error" v-if="errors.has('key')">@{{ errors.first('key') }}</span>
                        </div>
                    </div>
                </accordian>
            </div>
        </form>
    </div>
@endsection