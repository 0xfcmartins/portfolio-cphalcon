<!DOCTYPE html>

<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pt">
<![endif]-->

<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="pt">
<![endif]-->

<!--[if IE 8]>
<html class="no-js lt-ie9" lang="pt">
<![endif]-->

<!--[if gt IE 8]><!-->
<html lang="pt">
<!--<![endif]-->

{% include "partials/head.volt" %}

<body>

<!--[if lt IE 9]>
	<div class="alert alert-danger alert-dismissable text-center" role="alert">
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
		</button>
		<p class="lead">{{ this.translator.getMessage('old-browser') }}</p>
	</div>
<![endif]-->

<canvas id="canvas1"></canvas>

{% block content %}{% endblock %}
{% block scripts %}{% endblock %}

{% include "partials/footer.volt" %}

</body>
</html>

