<div class="w-full h-full">
    <div class="flex items-stretch">
        @if($isModal)
        <div style="width: 400px">
            <img src="{{ asset('images/assets/login.png') }}" alt="Login" class="w-full h-full object-cover">
        </div>
        @endif
        <div class="flex-1 bg-program bg-white p-10 h-full overflow-y-auto">
            <div class="space-y-5">
                @if($isModal)
                <div class="flex justify-end hover:cursor-pointer" id="btn-close-register">
                    <img src="{{ asset('images/icons/close.png') }}" alt="Close" class="w-[32px] aspect-square">
                </div>
                @endif
                <div class="space-y-3">
                    <div class="text-title text-main-gradient">Daftar Akun</div>
                    <div>Lengkapi form di bawah dengan menggunakan data Anda yang valid</div>
                </div>
                <form wire:submit.prevent="submit" class="space-y-3">
                    <div>
                        <label for="">Nama Lengkap</label>
                        <input wire:model.defer="nama" type="text" class="w-full rounded-xl bg-white px-6 py-4 border-2" placeholder="Masukan nama lengkap anda..">
                        @error('nama')
                        <div class="text-red-600">*) {{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="">Email addresss</label>
                        <input wire:model.defer="email" type="email" class="w-full rounded-xl bg-white px-6 py-4 border-2" placeholder="Cth: maghfirah@gmail.com">
                        @error('email')
                        <div class="text-red-600">*) {{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="">Password</label>
                        <input wire:model.defer="password" type="password" class="w-full rounded-xl bg-white px-6 py-4 border-2" placeholder="Masukan password anda">
                        @error('password')
                        <div class="text-red-600">*) {{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="">Konfirmasi Password</label>
                        <input wire:model.defer="konfirmasi_password" type="password" class="w-full rounded-xl bg-white px-6 py-4 border-2" placeholder="Masukan password anda">
                        @error('konfirmasi_password')
                        <div class="text-red-600">*) {{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button wire:loading.attr="disabled" wire:target="submit" type="submit" class="w-full bg-main-gradient rounded-xl py-4 px-6 text-white text-center">
                            <span wire:loading.remove wire:target="submit">Daftar</span>
                            <span wire:loading wire:target="submit">memproses...</span>
                        </button>
                    </div>
                </form>
                <div class="space-y-3 text-center">
                    <div>Sudah memiliki akun ?</div>
                    <div>
                        @if($isModal)
                        <a href="javascript:void(0)" class="btn-login">
                        @else
                        <a href="{{ url('/login') }}">
                        @endif
                            <div class="bg-main-gradient p-0.5 rounded-xl">
                                <div class="py-[0.875rem] px-[1.375rem] rounded-xl bg-white space-y-5 text-center">Masuk</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
