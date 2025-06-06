<h2>Tere, {{ $data['name'] }}!</h2>

<p>Oleme saanud sinu hobusesõidu broneeringu:</p>

<ul>
    <li><strong>Aeg:</strong> {{ $data['datetime'] }}</li>
    <li><strong>E-post:</strong> {{ $data['email'] }}</li>
    <li><strong>Sõnum:</strong> {{ $data['message'] ?? '—' }}</li>
</ul>

<p>Võtame sinuga peagi ühendust kinnituseks.</p>

<p>Parimate soovidega,<br>Reinutalu</p>