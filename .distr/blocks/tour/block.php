<section class="tour">
	<div class="container">
		<div class="tour__inner">
			{% if (tours | default([])) | length == 0 %}
				{% import 'tour/data.njk' as tourdata %}
				{% set tours = tourdata.getTours() %}
			{% endif %}
			<div class="tour__header">
				<div class="tour__header-title">Подбор тура</div>
				<div class="tour__header-count">Всего туров: {{ (tours | default([])) | length }}</div>
			</div>

			<div class="tour__filters">
				<div class="tour__filter" data-filter="type">
					<div class="tour__filter-button">Тип</div>
				</div>
				<div class="tour__filter" data-filter="duration">
					<div class="tour__filter-button">Продолжительность</div>
				</div>
				<div class="tour__filter" data-filter="price">
					<div class="tour__filter-button">Цена</div>
				</div>
			</div>

			<div class="tour__tags"></div>

			<div class="tour__cards">
				{% for t in (tours | default([])) %}
					<div class="tour__card"
						data-type="{{ (t.type | default('')) | escape }}"
						data-duration="{{ (t.duration | default('')) | escape }}"
						data-price="{{ (t.price | default(0)) }}"
						data-tags="{{ (t.tags | default([])) | join(',') | escape }}"
					>
						<div class="tour__card-top">
							<img src="{{ (t.image | default('img/offer/image-1.png')) | escape }}" alt="" class="tour__card-image">
							<a href="product.php" class="tour__card-button">Подробнее</a>
						</div>
						<div class="tour__card-title">{{ t.title | default('Название тура') }}</div>
						<p class="tour__card-description">{{ t.description | default('Краткое описание тура') }}</p>
						<div class="tour__card-tags">
							{% for tag in (t.tags | default([])) %}
								<span class="tour__card-tag">{{ tag }}</span>
							{% endfor %}
						</div>
						<div class="tour__card-price">{{ (t.price | default(0)) }} ₽</div>
					</div>
				{% endfor %}
			</div>
			<div class="tour__more" hidden>
				<button class="tour__more-button">Показать ещё <span class="tour__more-count"></span></button>
			</div>
		</div>
	</div>
</section>


