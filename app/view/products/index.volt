{{ form("products/search") }}

<h2>Search products</h2>

<fieldset>

    {% for element in form %}
        <div class="control-group">
            {{ element.label(['class': 'control-label']) }}
            <div class="controls">{{ element }}</div>
        </div>
    {% endfor %}

    <div class="control-group">
        {{ submit_button("Search", "class": "btn btn-primary") }}
    </div>

</fieldset>