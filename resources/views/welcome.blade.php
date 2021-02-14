@extends('layouts/HeaderPage')
@section('content')
<div class="" class="img"
style="background-image: url('{{ asset('img/banner.jpg') }}');    
height: 200px; /* You must set a specified height */
background-position: center; /* Center the image */
position: relative;
top: -23px;
right: 7%;
width: 110%;
background-repeat: no-repeat; /* Do not repeat the image */
background-size: cover; /* Resize the background image to cover the entire container */"
>
<div class="text-center p-2 h1">

	<div >
		<p class="font-weight-bold"><p class="h6">The Skin Power</p>Tu mejor elección</p>
		<p class="typed h5 text-center"></p>

	</div>


</div>
</div>
<div class="container-fluid">

	


	<!-- Marketing messaging and featurettes-->

	<!-- Wrap the rest of the page in another container to center all the content. -->

	
	<div class="row">

		<div class="col-sm-3">
			<div class="card mb-3 "style="border-color: pink">
				<div class="card-body">
					<div class="card-img img-fluid img mx-auto mb-2 ">
						<img src="{{ asset('img/TheSkinPower4.jpg') }}" width="250" height="150" alt="">	
					</div>
					<h4 class="card-title">Tu tipo de piel</h4>
					<p class="card-text text-justify">
						Todos los tipos de pieles deben realizar diferentes rutinas adecuadas a sus necesidades, así que huye de los que te recomienden la misma rutina que ellos usan porque les funcionó.  <br>

						Que les haya funcionado a ellos no quiere decir que te funcione a tí, así que acá te dejo unos ejemplos de como debería ser tu rutina según tu tipo de piel 💞 <br>
					</p>

					<b>PIEL SECA: </b>
					<ul>
						<li> Limpiadores tipo syndet o leches limpiadoras</li>
						<li> Hidratantes densos</li>
						<li> Protector solar humectante</li>
						<li> Serums nutritivos: ácido hialurónico, vitaminas C,E y B5, peptidos. </li>
						<li> Exfoliar 1 vez a la semana </li>
					</ul>
					<br>

					<b>PIEL GRASA :</b>
					<ul>
						<li> Limpiadores en gel </li>
						<li>Hidratantes en gel </li>
						<li> Tónico seborregulador</li>
						<li> Sérum de base acuosa sin aceite: Niacinamide, Vitamina C, Retinol, Ácido Salicílico</li>
						<li> Protector solar en gel</li> 
						<li> Exfoliar 2 veces a la semana </li>
					</ul>

					<b>PIEL MIXTA: </b>
					<ul>
						<li> Limpiadores syndet </li>
						<li> Hidratación nutritiva ligera </li>
						<li> sérum de base acuosa nutritivos: Marine Hialurónics, Ácido Hialurónico, Ácido Salicílico, Niacinamida. </li>
						<li> Protector solar ligero humectante </li>
						<li> Exfoliar 2 veces a la semana</li>
					</ul>

					<b>PIEL SENSIBLE: </b>
					<ul>
						<li>Loción limpiadora y agua Thermal </li>
						<li> Hidratantes ligeros sin alcohol ni fragancias </li>
						<li> Sérum: ácido hialurónico, marine hialurónics, ascorbyl glucoside, ácido Láctico</li> 
						<li>Protector solar físico</li>
						<li> Exfoliar 1 vez a la semana, es aconsejable el ácido Láctico.</li>
					</ul>
				</div>
			</div>

		</div>


		<div class="col-sm-3">
			<div class="card mb-3 "style="border-color: pink">
				<div class="card-body">
					<div class="card-img img-fluid img mx-auto mb-2 ">
						<img src="{{ asset('img/TheSkinPower5.jpg') }}" width="250" height="150" alt="">	
					</div>
					<h4 class="card-title">Activos que necesitas según tu edad 👶🧓</h4>
					<p class="card-text text-justify">
						Muchas veces vamos por la vida comprando tanta cosa que no necesitamos, conoce cuáles son tus necesidades y qué te conviene, recuerda que nuestro principal órgano (la piel) va cambiando con los años, dale lo que necesita. <br> <br>

						<b>Muchach@s nuestra piel nos habla </b><br> <br>

						De 20 a 25 años la rutina debe basarse en una rutina de prevención que consta de hidratación protección, sin embargo yo agregaría antioxidantes de acuerdo a la necesidad de cada piel. <br> <br>

						De 25 a 30 años es momento de añadir retinoides en la rutina, pues son los años en dónde las arrugas y líneas de expresión empiezan a notarse. Durante este tiempo buscaremos combatir el envejecimiento prematuro e impulsar la regeneración celular.<br> <br>

						De 40 a 50 años la capacidad de retención de agua que tenía nuestra piel años atrás no es la misma que estando en estas edades, por lo cual es necesario agregar productos que impulsen la producción de colágeno y retengan de mejor manera la Hidratación, los productos estrellas serán los peptidos, retinoides y antioxidantes. <br> <br>

						De 50 años en adelante es necesario darle un cóctel a nuestra piel de ceramidas, peptidos, antioxidantes e hidrantantes nutritivos<br>
					</p>

				</div>
			</div>
		</div>



		<div class="col-sm-3">
			<div class="card mb-3 "style="border-color: pink">
				<div class="card-body">
					<div class="card-img img-fluid img mx-auto mb-2 ">
						<img src="{{ asset('img/TheSkinPower7.jpg') }}" width="250" height="150" alt="">	
					</div>
					<h4 class="card-title">El orden de los factores si altera el resultado😱‼️😱‼️</h4>
					<p class="card-text text-justify">
					Existen millones de productos en el mercado con diferentes texturas formuladas para cada tipo de piel; estas texturas son el vehículo de nuestros activos para que penetren mejor la piel y así tener los resultados esperados.</p> <br>

					<b>Por eso, es importante que :</b>

					<ul>
						<li>Tengas el tipo de piel que tengas, hay que aplicar de lo más ligero a lo más denso (ejemplo: la numeración de los productos en el post)</li> 

						<li>Saber qué tipo de textura es la adecuada para tu rostro: para pieles grasas las texturas recomendadas son acuosas y geles, para pieles mixtas y sensibles las texturas deben ser cremas gel ligeras y para pieles secas cremas densas nutritivas. </li>

						<li>Ten en cuenta que si no eliges bien el tipo de textura puedes ocasionar un resultado opuesto a lo que buscas‼️</li>

						<li>Aplicar la cantidad adecuada, más no significa mejores resultados‼️.En mis inicios caí en esto😂🤦🏻‍♀️, no lo hagan, pueden obstruir los poros de tanto producto.</li>
					</ul>


				</div>
			</div>
		</div>


		<div class="col-sm-3">
			<div class="card mb-3 "style="border-color: pink">
				<div class="card-body">
					<div class="card-img img-fluid img mx-auto mb-2 ">
						<img src="{{ asset('img/TheSkinPower6.jpg') }}" width="250" height="150" alt="">	
					</div>
					<h4 class="card-title">No lo hagas más‼️</h4>
					<p class="card-text text-justify">
						✖️Tocarte la piel, terminar de quitarte los puntos negros o espinillas que te quedaron es mala idea, recuerda que la piel está sensible y propensa a agarrar infecciones y bacterias.  <br><br>

						✖️Maquillarte, lo más recomendable es esperar 72 hrs.  <br><br>

						✖️ Seguir con tu rutina facial, después de una limpieza lo importante es usar hidrantantes, calmantes y regenerantes. Evita usar ácidos, tratamientos anti-acné y retinol. Espera a que pasen las 72 hrs.  <br><br>

						✖️ Hacer ejercicio, el sudor puede irritar cuando la piel está en un estado sensible. <br><br>

						✖️Irte a la playa, el calor y el sol promueven la inflamación. Además estás más propensas a manchas.  <br><br>

						Extra: ✖️Depilarte, no es momento de hacerte las cejas ni el bozo. 
					</p>

				</div>
			</div>
		</div>

	</div>


{{-- <div>
	<H1>Servicios</H1>
</div> --}}
</div>


</div>
@stop



@section('script')
<script src="{{ asset('js/typed.js') }}"></script>
<script src="{{ asset('js/mainTyped.js') }}"></script>
@stop
