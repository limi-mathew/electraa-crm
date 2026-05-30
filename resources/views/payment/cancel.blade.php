@extends ('layouts.app')

@section ('content')
    <div class="container mx-auto px-4 py-12">
        <div
            class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8 text-center"
        >
            <div class="mb-4">
                <svg class="w-16 h-16 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Payment Cancelled
            </h1>

            <p class="text-gray-600 mb-6">Your payment has been cancelled. If you have any questions, please contact our support team.</p>

            <div class="space-y-3">
                <a
                    href="{{ route('dashboard') }}"
                    class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition"
                >
                    Back to Dashboard
                </a>
                <a
                    href="{{ route('payments.index') }}"
                    class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition"
                >
                    View Payment History
                </a>
            </div>
        </div>
    </div>
@endsection
