<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        {{ $logo }}
    </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <center>
            <label style="font-size:28px; display:inline-block;">
                <b>PLATAFORMA VIRTUAL</b>
            </label> 
            <br>
            <img src="{{ asset('/images/logo2.png') }}" alt="" style="padding:10px; width: 200px; display:inline-block;">
            <br>
            <label>
                <b>Sistema de Gestión Académica</b>
            </label>
            <br>
            <label>
                <b>IE. Ricardo Palma</b>
            </label>
        </center>
        {{ $slot }}
    </div>
</div>
