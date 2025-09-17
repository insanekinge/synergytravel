<section class="tour">
	<div class="container">
		<div class="tour__inner">
			{% if (tours | default([])) | length == 0 %}
				{% import 'tour/data.njk' as tourdata %}
				{% set tours = tourdata.getTours() %}
			{% endif %}
			<div class="tour__header">
				<div class="tour__header-title">Наши туры</div>
				<div class="tour__header-count">{{ (tours | default([])) | length }}</div>
			</div>

			<div class="tour__filters">
				<div class="tour__filter" data-filter="type">
					<div class="tour__filter-button">По типу</div>
				</div>
				<div class="tour__filter" data-filter="duration">
					<div class="tour__filter-button">По продолжительности</div>
				</div>
				<div class="tour__filter" data-filter="price">
					<div class="tour__filter-button">По цене</div>
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
						style="background-image: url('{{ (t.image | default('img/offer/image-1.png')) | escape }}');"
					>
						<div class="tour__card-header">
							<div class="tour__card-tags">
								{% for tag in (t.tags | default([])) %}
									<span class="tour__card-tag">{{ tag }}</span>
								{% endfor %}
							</div>
						</div>
						<div class="tour__card-content">
							<div class="tour__card-title">{{ t.title | default('Название тура') }}</div>
							<p class="tour__card-description">{{ t.description | default('Краткое описание тура') }}</p>
							<div class="tour__card-bottom">
							<a href="product.php" class="tour__card-button">Подробнее</a>
								<div class="tour__card-price">от{{ (t.price | default(0)) }} ₽</div>
							</div>
						</div>
					</div>
				{% endfor %}
			</div>
			<div class="tour__more" hidden>
				<button class="tour__more-button">Показать ещё <span class="tour__more-count">( )</span></button>
			</div>
		</div>
	</div>
</section>


