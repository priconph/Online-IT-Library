@php $layout = 'layouts.user_layout'; @endphp
@auth
    @php
        if(Auth::user()->user_level_id == 1){
            $layout = 'layouts.admin_layout';
        }
        else if(Auth::user()->user_level_id == 2){
            $layout = 'layouts.user_layout';
        }
    @endphp

    {{-- if user's id is not equal to 1 (Administrator) --}}
    @if(Auth::user()->user_level_id != 1)
        <script type="text/javascript">
            window.location = "user"; // user dashboard
        </script>
    @endif
@endauth

@auth
    @extends($layout)

    @section('title', 'Dashboard')

    @section('content_page')
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 mt-4">
                                <div class="card l-bg-blue-dark card-hover">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Users</h5>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    <span class="totalUsers"></span>
                                                </h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a class="text-white" href="{{ route('user_management') }}"><i class="fa fa-4x fa-arrow-right"></i></a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 mt-4">
                                <div class="card l-bg-blue-dark card-hover">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large"><i class="fas fa-clipboard-list"></i></div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total List of Workloads</h5>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    <span class="totalWorkloads"></span>
                                                </h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a class="text-white" href="{{ route('list_of_workloads') }}"><i class="fa fa-4x fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </section>
        </div>
    @endsection
    
    <!--     {{-- JS CONTENT --}} -->
    @section('js_content')
    <script type="text/javascript">
        $(document).ready(function () {
            //============================== GET TOTAL WORKLOADS FOR DASHBOARD ==============================
            function totalWorkloads(){
                $.ajax({
                    url: "get_total_workloads",
                    method: "get",
                    dataType: "json",
                    success: function (response) {
                        $('.totalWorkloads').text(response['totalWorkloads']);
                        // console.log(response['totalWorkloads']);
                    }
                });
            }
            totalWorkloads();


            //============================== GET TOTAL USERS FOR DASHBOARD ==============================
            function totalUsers(){
                $.ajax({
                    url: "get_total_users",
                    method: "get",
                    dataType: "json",
                    success: function (response) {
                        $('.totalUsers').text(response['totalUsers']);
                        // console.log(response['totalUsers']);
                        let name = response['getOne'].name

                        encrypt('Gm14pxgf70PsBNmjd+HvE+2rLvwylN4lyTlMRNmRui4=', name);
                    }
                });
            }
            totalUsers();


            //============================== SIGN OUT ==============================
            $(document).ready(function(){
                $("#formSignOut").submit(function(event){
                    event.preventDefault();
                    SignOut();
                });
            });

            function encrypt(keyParam, dataParam){
                console.log('encrypt() is called');
                // Creates a word array filled with random bytes.
                // @param {number} nBytes The number of random bytes to generate.
                let iv = CryptoJS.lib.WordArray.random(16)
                let key = CryptoJS.enc.Base64.parse(keyParam);
                let options = {
                    iv: iv,
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7,
                };

                let encrypted = CryptoJS.AES.encrypt(JSON.stringify(dataParam), key, options).toString();
                console.log('encrypted: ', encrypted);
                iv = CryptoJS.enc.Base64.stringify(iv);

                let result = {
                    iv: iv,
                    value: encrypted,
                    mac: CryptoJS.HmacSHA256(iv + encrypted, key).toString(),
                };
                result = CryptoJS.enc.Utf8.parse(JSON.stringify(result));
                console.log('result ', CryptoJS.enc.Base64 .stringify(result));
            }
            

            // Encrypt
            // var ciphertext = CryptoJS.AES.encrypt('my message', 'Gm14pxgf70PsBNmjd+HvE+2rLvwylN4lyTlMRNmRui4=').toString();
            // console.log('ciphertext ', ciphertext); // 'my message'

            // var HmacSHA256 = CryptoJS.HmacSHA256('my message', 'Gm14pxgf70PsBNmjd+HvE+2rLvwylN4lyTlMRNmRui4=').toString();
            // console.log('HmacSHA256 ', HmacSHA256); // 'my message'

            // // // Decrypt
            // // var bytes  = CryptoJS.AES.decrypt(ciphertext, 'secret key 123');
            // // var originalText = bytes.toString(CryptoJS.enc.Utf8);

            // console.log('originalText ',originalText); // 'my message'
        });
    </script>
    @endsection
@endauth