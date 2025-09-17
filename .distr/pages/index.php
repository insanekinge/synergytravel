{% extends "default.php" %}

{% block blocks %}
	{% include 'header/block.php' %}
	{% include 'main/block.php' %}
	{% include 'about/block.php' %}
	{% include 'partners/block.php' %}
	{% include 'offer/block.php'%}
	{% set tours = [
	  {
	    image: 'img/offer/image-1.png',
	    title: 'Тестовый тур — Москва',
	    description: 'Тестовое описание тура для проверки рендера',
	    price: 19990,
	    type: 'Образовательные',
	    duration: '3 дня',
	    tags: ['Образовательные','Литературные','Студентам']
	  },
	  {
	    image: 'img/offer/image-4.png',
	    title: 'Зеленая Россия — Казань и окрестности',
	    description: 'Экодостопримечательности и отдых для всей семьи',
	    price: 48000,
	    type: 'Экологические',
	    duration: '5 дней',
	    tags: ['Экологические','Сотрудникам','Российские курорты','Подходят для семьи']
	  },
	  {
	    image: 'img/offer/image-2.png',
	    title: 'Выходные в Санкт‑Петербурге',
	    description: 'Классические маршруты и современные пространства',
	    price: 69000,
	    type: 'Культурные',
	    duration: '2 дня',
	    tags: ['Культурные','Российские курорты','Подходят для семьи','Студентам','Сотрудникам']
	  },
	  {
	    image: 'img/offer/image-3.png',
	    title: 'Горы Кавказа',
	    description: 'Трекинг и здоровье',
	    price: 35000,
	    type: 'Активные',
	    duration: '7 дней',
	    tags: ['Активные','Подходят для семьи']
	  },
	  {
	    image: 'img/offer/image-5.png',
	    title: 'Байкал. Зимний тур',
	    description: 'Лёд, снег и впечатления',
	    price: 54000,
	    type: 'Природные',
	    duration: '6 дней',
	    tags: ['Природные','Российские курорты']
	  },
	  {
	    image: 'img/offer/image-6.png',
	    title: 'Калининград и Куршская коса',
	    description: 'Европейский уголок России',
	    price: 41000,
	    type: 'Культурные',
	    duration: '4 дня',
	    tags: ['Культурные','Подходят для семьи']
	  },
	  {
	    image: 'img/offer/image-45.png',
	    title: 'Алтай. Ворота в Азию',
	    description: 'Долины, перевалы, этно',
	    price: 62000,
	    type: 'Активные',
	    duration: '8 дней',
	    tags: ['Активные','Экологические']
	  }
	] %}
	{% include 'tour/block.php' %}
	{% include 'footer/block.php' %}
{% endblock %}

{% block popups %}
{% endblock %}

{% block js %}
<script src="js/main.js"></script>
<script src="js/partners.js"></script>
<script src="js/tour.js"></script>
{% endblock %}