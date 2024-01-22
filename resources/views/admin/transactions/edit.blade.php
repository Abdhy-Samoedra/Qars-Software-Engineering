<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Transaction &raquo; Edit &raquo; #') . $transaction->id !!}
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
                                id="grid-last-name" type="date" placeholder="Expired Date" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Start Date. Example: 01/04/2004, 02/08/2018, etc.
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                End Date
                            </label>
                            <input value="{{ old('end_date') ?? $transaction->end_date }}" name="end_date"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="date" placeholder="Expired Date" required>
                            <div class="mt-2 text-sm text-gray-500">
                                End Date. Example: 01/04/2004, 02/08/2018, etc.
                            </div>
                        </div>
                        <div class="grid w-full grid-cols-2 gap-4 px-3 mb-4 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    extend*
                                </label>
                                <input value="{{ old('extend') ?? $transaction->extend }}" name="extend"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="extend">
                                <div class="mt-2 text-sm text-gray-500">
                                    How Many Days That the Rental is Extended. Example : 1, 2, 3, etc.
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    penalty*
                                </label>
                                <input value="{{ old('penalty') ?? $transaction->penalty }}" name="penalty"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="penalty">
                                <div class="mt-2 text-sm text-gray-500">
                                    Number of Days After the day of deadline. Example : 1, 2, 3, etc.
                                </div>
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Status transaction
                            </label>
                            <select name="status" required
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="Pending" {{ $transaction->status === 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="Confirmed" {{ $transaction->status === 'Confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="Done" {{ $transaction->status === 'Done' ? 'selected' : '' }}>Done
                                </option>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Status of the Transaction. Example: Pending or Confirmed
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Payment status
                            </label>
                            <select name="payment_status" required
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
                            <div class="mt-2 text-sm text-gray-500">
                                Status of Payment. Example: Pending, Success, Failed, Expired.
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Payment URL
                            </label>
                            <input value="{{ old('payment_url') ?? $transaction->payment_url }}" name="payment_url"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="payment_url" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Link of the payment. Auto
                            </div>
                        </div>
                        <div class="grid w-full grid-cols-2 gap-4 px-3 mb-4 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Exp Reward*
                                </label>
                                <input value="{{ old('exp_reward') ?? $transaction->exp_reward }}" name="exp_reward"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="exp_reward " required>
                                <div class="mt-2 text-sm text-gray-500">
                                    Quantity of experience gained.
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Total*
                                </label>
                                <input value="{{ old('total_price') ?? $transaction->total_price }}"
                                    name="total_price"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="penalty" required>
                                <div class="mt-2 text-sm text-gray-500">
                                    Total of price paid, Example : 100000, 20000, 30000, etc.
                                </div>
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle
                            </label>
                            <input value="{{ old('vehicle_id') ?? $transaction->vehicle->id }}" name="vehicle_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="vehicle_id" required>
                            <div class="mt-2 text-sm text-gray-500">
                                License Plate of the Vehicle. Example: B 1389 CKN, A 9128 PPO, etc.
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                User Id
                            </label>
                            <input value="{{ old('user_id') ?? $transaction->user->id }}" name="user_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="user_id" required>
                            <div class="mt-2 text-sm text-gray-500">
                                User ID. Example : 1, 2, 3, etc.
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Driver
                            </label>
                            <input value="{{ old('driver_id') ?? ($transaction->driver->id ?? '') }}"
                                name="driver_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Driver">
                            <div class="mt-2 text-sm text-gray-500">
                                Driver ID. Example : 1, 2, 3, etc.
                            </div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Voucher Id
                            </label>
                            <input value="{{ old('voucher_id') ?? ($transaction->voucher_category->id ?? '') }}"
                                name="voucher_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Voucher ID">
                            <div class="mt-2 text-sm text-gray-500">
                                Voucher ID. Example : 1, 2, 3, etc.
                            </div>
                        </div>
                    </div>




            </div>

            <div class="flex flex-wrap mb-6 -mx-3">
                <div class="w-full px-3 text-right">
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                        Simpan Transaction
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
