@component('mail::message')
# مرحبا بك:  {{$user->name}}

تم تسجيل حسابك في بوابة إدراة المنح لمؤسسة سالم بالحمر الخيرية. لتنشيط حسابك، الرجاء متابعة رز التنشيط.

@component('mail::button', ['url' => '', 'color' => 'balahmar'])
تنشيط
@endcomponent

دمتم في رعاية الله...<br>
لجنة الأمناء بمؤسسة بالحمر الخيرية
@endcomponent
