@include('layout/header')
<div id="app">
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">                   
        <a class="navbar-brand" href="#">Dashboard</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                </ul>
            </nav>
            <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">          
                <router-view></router-view>
            </main>
        </div>
    </div>
</div>
@include('/layout/footer')
