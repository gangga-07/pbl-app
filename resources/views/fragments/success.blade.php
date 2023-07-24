<div class="fixed bg-slate-900 w-screen h-screen bg-opacity-50 z-[999999]" id="alert">
    <div class="absolute top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] bg-white border-4 border-emerald-600 rounded-lg text-emerald-600 px-10 py-10 shadow-md"
        role="alert">
        <div class="flex">
            <div class="py-1">
                <i class="h-5 w-5 text-emerald-600 mr-2 text-lg font-bold" data-lucide="check-circle-2"></i></div>
            <div>
                <p class="text-lg font-bold">Congrats!</p>
                <p class="text-sm">{!! session()->get('success') !!}</p>
            </div>
        </div>
        <div class="flex justify-end pt-5">
            <button onclick="btn_close()" class="bg-emerald-600 rounded-md p-3 py-1 font-medium text-white">Close</button>
        </div>
    </div>
</div>

<script>
    function btn_close() {
        document.getElementById("alert").style.display = "none";
    }
</script>
