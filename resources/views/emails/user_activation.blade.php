@component('mail::message')
 # مرحبا بك:  {{$user->name}}

تم تسجيل حسابك في بوابة إدراة المنح لمؤسسة سالم بالحمر وعائلته الخيرية. لتفعيل حسابك الرجاء متابعة رز التفعيل أدناه. سوف يطلب منك البوابة إدخال الرمز المرسل لجوالك.

@component('mail::button', ['url' => url('/activation?email='). $user->email . '&token=' . $user->token, 'color' => 'balahmar'])
تفعيل
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء الأمناء بمؤسسة سالم بالحمر الخيرية.
@endcomponent