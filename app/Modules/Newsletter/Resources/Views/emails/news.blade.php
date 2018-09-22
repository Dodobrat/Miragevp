Hello! Mail working.



<h1>Text from subject in fr</h1>
<h3>{{ $newsletter->getTranslation($subscriber->locale)->subject }}</h3>

<h1>Text from content in fr</h1>
<p>{!! $newsletter->getTranslation($subscriber->locale)->content !!}</p>
