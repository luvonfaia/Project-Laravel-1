<x-layout>
    <div class="container py-md-5">
        <div class="row align-items-center">
            <div class="col-lg-7 py-3 py-md-5">
                <h1 class="display-3">Lorem Impsum?</h1>
                <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium ad aperiam blanditiis illo incidunt odit, sapiente unde. Aspernatur dignissimos dolorum harum iste laboriosam magnam rem rerum similique suscipit voluptas.</p>
            </div>
            <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
                <form action="/register" method="POST" id="registration-form">
                    @csrf
                    <div class="form-group">
                        <label for="username-register" class="text-muted mb-1"><small>Utilizator</small></label>
                        <input value="{{old('username')}}" name="username" id="username-register" class="form-control" type="text" placeholder="Alege un utilizator" autocomplete="off" />
                    @error('username')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
                        <input value="{{old('email')}}" name="email" id="email-register" class="form-control" type="text" placeholder="nume@exemplu.com" autocomplete="off" />

                        @error('email')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-register" class="text-muted mb-1"><small>Parola</small></label>
                        <input name="password" id="password-register" class="form-control" type="password" placeholder="Creaza o parola" />

                        @error('password')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-register-confirm" class="text-muted mb-1"><small>Confirma parola</small></label>
                        <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Confirma parola" />

                        @error('password_confirmation')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Inregistreaza-te!</button>
                </form>
            </div>
        </div>
    </div>



</x-layout>

