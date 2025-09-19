{% extends "default.php" %}

{% set title = "Регистрация - Synergy Travel" %}
{% set description = "Регистрация нового пользователя Synergy Travel" %}

{% block styles %}
{{ super() }}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
	.register{ font-family: 'Inter', 'Raleway', Arial, sans-serif; }
</style>
{% endblock %}

{% block blocks %}
	{% include 'header/block.php' %}
	{% include 'register/block.php' %}
	{% include 'footer-register/block.php' %}
{% endblock %}

{% block popups %}
{% endblock %}

{% block js %}
<script src="js/register.js"></script>
{% endblock %}
