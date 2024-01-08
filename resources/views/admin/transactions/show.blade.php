<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Transaction &raquo; Details &raquo; #') . $transaction->id !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                            Ada kesalahan!
                        </div>
                        <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form class="w-full" action="{{ route('admin.transactions.update', $transaction->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="flex flex-wrap px-3 mt-4 mb-4 -mx-3">
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Start Date
                            </label>
                            <input value="{{ old('start_date') ?? $transaction->start_date }}" name="start_date"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Expired Date" required disabled>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                End Date
                            </label>
                            <input value="{{ old('end_date') ?? $transaction->end_date }}" name="end_date"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Expired Date" required disabled>
                        </div>
                        <div class="grid w-full grid-cols-2 gap-4 px-3 mb-4 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    extend*
                                </label>
                                <input value="{{ old('extend') ?? $transaction->extend }}" name="extend"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="extend" required disabled>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    penalty*
                                </label>
                                <input value="{{ old('penalty') ?? $transaction->penalty }}" name="penalty"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="penalty" required disabled>
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Status transaction
                            </label>
                            <select name="status" required disabled
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="Pending" {{ $transaction->status === 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="Confirmed" {{ $transaction->status === 'Confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="Done" {{ $transaction->status === 'Done' ? 'selected' : '' }}>Done
                                </option>
                            </select>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Payment status
                            </label>
                            <select name="payment_status" required disabled
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="Pending"
                                    {{ $transaction->payment_status === 'Pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="Success"
                                    {{ $transaction->payment_status === 'Success' ? 'selected' : '' }}>
                                    Success</option>
                                <option value="Failed"
                                    {{ $transaction->payment_status === 'Failed' ? 'selected' : '' }}>
                                    Failed</option>
                                <option value="Expired"
                                    {{ $transaction->payment_status === 'Expired' ? 'selected' : '' }}>
                                    Expired</option>
                            </select>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Payment URL
                            </label>
                            <input value="{{ old('payment_url') ?? $transaction->payment_url }}" name="payment_url"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="payment_url" required disabled>
                        </div>
                        <div class="grid w-full grid-cols-2 gap-4 px-3 mb-4 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Exp Reward*
                                </label>
                                <input value="{{ old('exp_reward') ?? $transaction->exp_reward }}" name="exp_reward"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="exp_reward " required disabled>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Total*
                                </label>
                                <input value="{{ old('total_price') ?? $transaction->total_price }}" name="total_price"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="penalty" required disabled>
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle
                            </label>
                            <input value="{{ old('vehicle_id') ?? $transaction->vehicle->id }}" name="vehicle_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="vehicle_id" required disabled>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                User Id
                            </label>
                            <input value="{{ old('user_id') ?? $transaction->user->id }}" name="user_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="user_id" required disabled>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Driver
                            </label>
                            <input value="{{ old('driver_id') ?? $transaction->driver->id }}" name="driver_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Driver" disabled>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Voucher Id
                            </label>
                            <input value="{{ old('voucher_id') ?? $transaction->voucher_category->id }}" name="voucher_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Voucher ID" disabled>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
