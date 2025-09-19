{% extends "default.php" %}

{% set title = "Личный кабинет - Synergy Travel" %}
{% set description = "Личный кабинет пользователя Synergy Travel" %}

{% block blocks %}
	{% include 'header/block.php' %}
	{% include 'cabinet/block.php' %}
	{% include 'footer-register/block.php' %}
{% endblock %}

{% block popups %}
{% endblock %}

{% block js %}
<script src="js/cabinet.js"></script>
{% endblock %}
