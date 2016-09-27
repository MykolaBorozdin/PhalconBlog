<h2>Articles:</h2>
{% for article in articles  %}
   <div style="border-style: solid; margin-bottom: 15px; padding: 20px; border-radius: 15px;">
       <h3>{{article.title}}</h3>
       <p>Written by {{article.authorId}} {% if article.createdDate is defined%} on {{article.getCreatedDate()}}{%endif%} {% if article.updatedDate is defined%}, updated on {{article.getUpdatedDate()}} {%endif%} </p><br/>
       <p style="word-wrap: break-word;">{{article.text}}</p><br/>
       {% if currentUser == article.authorId %}
       {{link_to("article/edit"~"/"~article.getId(),"Edit article")}}
       {{link_to("article/delete"~"/"~article.getId(),"Remove article")}}
       {% endif%}
   </div>
{% endfor  %}
{{content()}}