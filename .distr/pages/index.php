{% extends "default.php" %}

{% block blocks %}
	{% include 'header/block.php' %}
	{% include 'main/block.php' %}
	{% include 'about/block.php' %}
	{% include 'partners/block.php' %}
	{% include 'offer/block.php'%}
	{% include 'footer/block.php' %}
{% endblock %}

{% block popups %}
{% endblock %}

{% block js %}
<script src="js/main.js"></script>
<script src="js/partners.js"></script>
{% endblock %}