@extends('layouts.dashboard-layout')
@section('dashboard-content')
<!-- BEGIN: Content -->
<div class="content">
    <!-- END: Top Bar -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update My Password
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form method="POST" action="{{ route('update-password') }}">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label for="oldPasswordInput" class="form-label">Old Password</label>
                        <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                            placeholder="Old Password" required>
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                            placeholder="New Password" required>
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                            placeholder="Confirm New Password" required>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('my-account') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                        <input type="submit" value="Save" class="btn btn-outline-primary shadow-md w-24 mr-1">
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
</div>
<!-- END: Content -->

<!-- Success Modal -->
<div class="modal" id="successModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Password updated successfully! You have been logged out for security purposes. Please log in with your new password.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END: Success Modal -->

<!-- Your other scripts and JavaScript libraries -->
<script>
    // Check if the URL has a query parameter 'passwordUpdated' set to 'success'
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('passwordUpdated') === 'success') {
        // Show the success modal if the password was updated successfully
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }

    // Function to log out the user when the modal is closed
    document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
        window.location.href = 'logout'; // Replace '/logout' with the actual logout URL in your application
    });
</script>
@endsection
