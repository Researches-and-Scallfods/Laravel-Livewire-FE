<div class="w-full h-full">
    <div class="flex items-stretch">
        <div class="flex-1 bg-program bg-white p-10 h-full overflow-y-auto">
            <div class="space-y-5">
                <div class="space-y-3">
                    <div class="text-title text-main-gradient">Lupa Password</div>
                    <div>Masukkan email anda untuk melakukan reset password</div>
                </div>

                @error('success')
                <div class="rounded-md p-3 shadow-md bg-green-300 text-green-600">{{ $message }}</div>
                @enderror

                <form class="space-y-3" wire:submit.prevent="submit">
                    <div>
                        <label for="">Alamat Email</label>
                        <input wire:model.defer="email" type="email" class="w-full rounded-xl bg-white px-6 py-4 border-2" placeholder="Cth: maghfirah@gmail.com">
                        @error('email')
                        <div class="text-red-600">*) {{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button wire:loading.attr="disabled" wire:target="submit" type="submit" class="w-full bg-main-gradient rounded-xl py-4 px-6 text-white text-center">
                            <span wire:loading.remove wire:target="submit">Kirim</span>
                            <span wire:loading wire:target="submit">memproses...</span>
                        </button>
                    </div>
                    <div class="text-end">
                        <a href="{{ url('/') }}">Ingat password ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
