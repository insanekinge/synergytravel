{% extends "default.php" %}

{% set title = "Регистрация - Synergy Travel" %}
{% set description = "Регистрация нового пользователя Synergy Travel" %}

{% block blocks %}
	{% include 'header/block.php' %}
	{% include 'register/block.php' %}
	{% include 'footer/block.php' %}
{% endblock %}

{% block popups %}
{% endblock %}

{% block js %}
<script src="js/register.js"></script>
{% endblock %}
