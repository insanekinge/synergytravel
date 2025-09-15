# Установка npm-модулей
```bash
npm install
```

# Настройка проекта
В `gulpfile.js` в конфиг вынесены основные параметры:
```js
var CONFIG = {
	output: 'public', /* Корневая папка сайта */
	input: '.distr/', /* Корневая папка дистрибутива */
	pages: '.distr/pages', /* Структура сайта в дистрибутиве */
	templates: '.distr/templates', /* Шаблоны сайта в дистрибутиве */
	blocks: '.distr/blocks', /* Блоки сайта в дистрибутиве */
	proxyPortPhp: 8002, /* Прокси-порт для PHP-сервера */
	proxyPortBs: 8910, /* Прокси-порт для browserSync */
	useAutoprefixer: false, /* Autoprefixer по умолчанию выключен */
	reload: true /* Перезагрузка браузера по умолчанию влючена */
}
```

Для переопределения настроек можно использовать свой файл `gulpconfig.json` (в корне проекта), например, если какой-то порт уже занят или нескольких проектов должны быть запущены параллельно:
```js
{
	"proxyPortPhp": 8003,
	"proxyPortBs": 8911
}
```

# Сборка проекта
Для сборки проекта в `gulpfile.js` есть две основные задачи:

1. `default` - сборка для dev (выполянется по умолчанию), без сжатия, с живой перезагрузкой в браузере (browserSync, порт :8910).
```bash
npm run gulp
```

2. `build` - просто сборка, без запуска browserSync.
```bash
npm run gulp build
```
или со сжатием, для production (в случае использования докера)
```bash
NODE_ENV=production npm run gulp build
```

Также есть есть две дополнительные задачи:

1. `nosync` - сборка для dev без поднятия PHP-сервера и browserSync.
```bash
npm run gulp nosync
```

2. `noreload` - сборка без перезагрузки страницы (когда не нужно, чтобы после изменений фокус каждый раз прыгал к самому началу страницы).
```bash
npm run gulp noreload
```


## Структура проекта
`pages` - структура сайта (версии, подпапки, index.php, version.php и т.д.). Копируется 1-в-1 в папку `public`, с предварительным парсингом шаблонов.<br>
Здесь также находятся:<br>
- папки `css` с главными `*.scss`-файлами проекта с @import-ами стилей всех нужных блоков и шрифтами
- папки `js` с главными `*.js`-файлами проекта с require-ми скриптов всех нужных блоков (используется синтаксис плагина [gulp-include](https://www.npmjs.com/package/gulp-include#include-directives))

`templates` - шаблоны страниц с инклюдами блоков. В качестве шаблонизатора используется [Nunjucks](https://mozilla.github.io/nunjucks/templating.html) ([Примеры](https://css-tricks.com/killer-features-of-nunjucks/))

`blocks` - блоки шаблонов

Блок - это не обязательно HTML-блок. Можно заводить логические блоки, например, `common`, `icon`, `fonts` и т.д. Каждый блок и его подключаемые файлы должны находиться в отдельной папке.

В папке блока может находиться:
* `block.php`- [шаблон блока](http://prntscr.com/ki23p8)
* `macro.php`- [макросы блока](http://prntscr.com/ki22y8)
* `data.php`- [данные блока](http://prntscr.com/ki242n)
* `img` - папка для изображений блока (внутри возможна любая вложенность)
* `_style.scss` - основные стили блока.  В качестве шаблонизатора используется [SCSS](https://sass-scss.ru/documentation/rasshirenie_css/) ([Статья на русском с примерами](https://habr.com/post/96417/), [Песочница-компилятор](https://www.sassmeister.com), [Примеры с БЭМ](https://www.sassmeister.com/gist/be4b839c6d3ffb59a9868718cf81de55))
* `_responsive.scss` - адаптивные стили блока
* `common.js` - скрипты блока

Во всех php-файлах также используется Nunjucks.<br>
Внутри `blocks` и `img` возможна любая вложенность.<br>
Для групировки блоков для других страниц рекомендуется использовать префикс `@` с именем страницы, например, если в структуре есть папка `version1`, блоки можно сложить в папку `@version1`.


## Логика сборки
### HTML
1. Сборщик пропускает php-файлы в папке `.distr/pages` через шаблонизатор Nunjucks.
1. Когда встречается упоминание `extends`, включается обработка шаблона из папки `templates`.
1. В шаблоне при нахождении `include` парсится шаблон блока из указанной папки.
1. В папку `public` копируются скомпилированные php-файлы из папки `.distr/pages`.

### Стили
1. Сборщик пропускает scss-файлы из папок `.distr/pages/*/css` через шаблонизатор SCSS.
1. Файлы с подчёркиванием '_', указанные с помощью `@import`, инклюдятся и компилируются. Файлы без подчёркивания компилируются автоматически в алфавитном порядке.
1. В `public/*/css` копируются скомпилированные css-файлы.

### Изображения
* В папку `public/img/*` копируются файлы из папок `.distr/blocks/*/img` (изображения блока копируются в папку блока).

### Скрипты
1. Сборщик пропускает js-файлы из папок `.distr/pages/*/js` через плагин `gulp-include`.
1. В `public/*/js` копируются скомпилированные js-файлы.

### Другие файлы
* Все остальные файлы из папки `.distr/pages` копируются в `public` в соответствии со своей структурой.


## Описание формата файла .helm/values.yaml для задания редиректов и зеркал. 
В примерах mdomain.com - основной домен, заданный в переменной PRODUCTION_URL проекта
### Редиректы
* Редирект https://domain2.com/lp/test -> https://mdomain.com
```yaml
redirects:
  - host: domain2.com
    path: /lp/test
```
* Редирект https://domain1.com -> https://mdomain.com/?lang=ru
```yaml
redirects:
  - host: domain1.com
    path: /
    query: lang=ru
```

### Зеркала
* Зеркало https://domain1.com/lp -> https://mdomain.com/?version=ru
```yaml
mirrors:
  - host: domain1.com
    path: /lp
    query: version=ru
```
* Зеркало https://domain1.com -> https://mdomain.com/sicily/?version=greece
```yaml
mirrors:
  - host: domain1.com
    path: /
    query: version=greece
    subdir: /sicily
```
* Зеркало https://domain2.com/lp/test -> https://mdomain.com/ и редирект https://domain2.com/lp/redir2 -> https://domain2.com/lp/test
```yaml
mirrors:
  - host: domain2.com
    path: /lp/test
    redirect:
      - host: domain2.com
        path: /lp/redir2

```


### Разное
* Блокировка сайта по коду страны (Код страны смотреть тут - https://www.geonames.org/countries/)
```yaml
block_code: "404"
block_countries:
  - desc: ОАЭ
    code: AE
  - desc: Саудовская Аравия
    code: SA
```

* Добавление страницы ошибок
```yaml
error_pages:
 - code: "404"
   page: /404/index.php
 - code: "500 502 503 504"
   page: /50x/index.php
```
