<?php
/* Template Name: JSON Data Page */

?>

<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>

			<div id="content" class="site-content clr">

				<?php do_action( 'ocean_before_content_inner' ); ?>

					<!-- wp:heading -->
					<h2 class="wp-block-heading">¿Qué ofrecemos?</h2>
					<!-- /wp:heading -->
					
					<!-- wp:paragraph -->
					<p>CCTransfers ofrece tres tipos de servicios básicos.</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p>Por un lugar, reservamos a los clientes trayectos de ida y/o vuelta entre el aeropuerto y su alojamiento. A partir de un precio fijo que depende de la zona de estadía.</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p>Por otro lado, damos a nuestros clientes particulares la posibilidad de convertirse en miembros plenos a través de nuestra página web. Estos podrán manejar sus propias reservas de forma intuitiva, y sin necesidad de intermediarios. Además de poder acceder y modificar todos los detalles de su reserva, mantener su historial de viajes, etc.</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p>Por último, ofrecemos a distintos alojamientos la posibilidad de convertirse en clientes corporativos. Estos serán capaces de administrar sus propias reservas y recibirán una comisión por viaje. Consultar datos sobre sus ingresos. Ver su historial de reservas. Entre otras cosas.</p>
					<!-- /wp:paragraph -->


					<!-- wp:image {"id":43,"sizeSlug":"full","linkDestination":"none","className":"is-style-default"} -->
					<figure class="wp-block-image size-full is-style-default"><img src="http://localhost/wp-content/uploads/2024/12/pexels-bkrustev-225203.jpg" alt="" class="wp-image-43"/></figure>
					<!-- /wp:image -->
					 
					<!-- wp:heading -->
					<h2 class="wp-block-heading">Servicios brindados</h2>
					<!-- /wp:heading -->

					<p>En esta tabla puede consultar las reservas realizadas por CodeCrafters. Ordenadas por zona, se muestra el número de traslados, el porcentaje que representa con respecto al total, los alojamientos y su número de traslados.</p>
					
					<div id="servicios-data"></div>

					<!-- wp:heading -->
					<h2 class="wp-block-heading">Obtén nuestros servicios</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>Para solicitar una reserva, o realizar cualquier consulta, usted puede contactarnos por nuestro teléfono o correo electrónico.</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p><strong>Correo electrónico</strong>: soportecliente@cct.com</p>
					<p><strong>Teléfono</strong>: 902202122</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p>Para convertirse en un cliente y disfrutar de los beneficios mencionados, usted puede simplemente registrarse en nuestra página web. <a href="https://fp064.techlab.uoc.edu/~uocx2/producto3">CodeCrafters Transfers</a></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p>Para colaborar como alojamiento, le invitamos a contactarnos a través de nuestros canales dedicados a socios corporativos.</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p><strong>Correo electrónico</strong>: corporativo@cct.com</p>
					<p><strong>Teléfono</strong>: 902202123</p>
					<!-- /wp:paragraph -->
				<?php do_action( 'ocean_after_content_inner' ); ?>

			</div><!-- #content -->

			<?php do_action( 'ocean_after_content' ); ?>

		</div><!-- #primary -->

		<?php do_action( 'ocean_after_primary' ); ?>

	</div><!-- #content-wrap -->

	<?php do_action( 'ocean_after_content_wrap' ); ?>

<?php get_footer(); ?>



<script>
document.addEventListener("DOMContentLoaded", () => {
    fetch("https://fp064.techlab.uoc.edu/~uocx2/producto3/api")
        .then(response => response.json())
        .then(data => {
            setData(data.data);
        })
        .catch(error => {
            document.getElementById('servicios-data').innerHTML = "Error recolectando datos";
        });
});

function setData(data){
    const datos = document.getElementById('servicios-data');

	let table = '<table class="transfers-data-table"><tr class="first-table-row">';

	Object.keys(data[0]).forEach(key => {
		if (key === 'hoteles')
			table += `<th >${key} (Numero traslados)</th>`;
		else if (key === 'numero_traslados')
			table += `<th>Traslados</th>`;
		else
			table += `<th>${key}</th>`;
	});
	table += "</tr>";

	data.forEach(item => {
		table += "<tr>";
		Object.entries(item).forEach(([key, value]) => {
			table += `<td>`
			if (key === "hoteles") {
				value.forEach((item, index) => {
					table += `${item['nombre_hotel']} (${item['numero_traslados']})<br>`
				});
			} else if (key === "porcentaje"){
				table += `${parseFloat(value).toFixed(2)} %`;
			} else {
				table += `${value}`;
			}
			table += `</td>`;
		});
		table += "</tr>";
	});


    table += "</table>";
	datos.innerHTML = table;
}

console.log("...")

</script>

<?php
get_footer();
?>

