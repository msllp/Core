
    <div id="msapp">

<div><h1>{{$data['title']}}</h1></div>

        <div class="card">

            <div class="card-body">
<div class="card-header card-heading">
    <h2>Hello @if(array_key_exists('name',$data)),{{$data['name']}} @endif</h2>
</div>


                <table class="table table-dark" style="    display: table;
    border-collapse: separate;
    border-spacing: 2px;
    border-color: #818182;width: 100%;
    margin-bottom: 1rem;
    color: #212529;">

                    <thead style="background-color: #818182">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

<div>

<div class="card-footer">
    <span class="text-right"> Best Regards,</span><br><br>
    Developer Team<br>

   <a href="https://www.millionsllp.com" target="_blank"> <img src="https://www.millionsllp.com/images/logo.png" alt="{{ config('app.name') }} Logo" style="max-height:60px"></a><br>
    Cloud | ERP | Enterprise Solutions | IT Services<br>

    Mobile: +91-7990563470 | E-mail: sales@millionsllp.com | Website: www.millionsllp.com<br>

    Presence in: Ahmadabad | Surat | Vapi | Mumbai | Noida | Bangalore | Vadodara | Chennai | United Kingdom<br>

   <span style="color: #1e7e34"> Save trees & help preserving our environment! Print this E-Mail only if necessary . </span>
</div>
</div>
    </div>

