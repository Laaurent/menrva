<user-component :user_log="{{ Auth::id() ? Auth::id() : 'null'  }}" :user_id="{{ $user_id }}"
    :is_student="{{ Auth::user()->user_type_id ==  1 }} "></user-component>