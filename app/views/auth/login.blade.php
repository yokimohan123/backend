@include('partials.header')
@section('content')
    <div class="content-container1">
        <div class="reg-customer">
            {{Form::open(['route' => 'frontend.auth.login'])}}
                <div class="Register"> 
                    <h5>Registered Customers</h5>

                    {{Form::label('email')}}
                    {{Form::email('email',null, ['id' => 'email'])}}
                    <p>{{$errors->first('email','<span class=error>:message</span>')}}</p>
                   
                    {{Form::label('password')}}
                    {{Form::input('password', 'password', null, ['id' => 'password'])}}
                    <p>{{$errors->first('password','<span class=error>:message</span>')}}</p>
                </div>
                <div class="Remember">
                    {{Form::checkbox('checkbox')}}
                    <span>Remember me</span>
                    <label for="forgotpassword"><a href="{{URL::route('frontend.auth.forget')}}">Forgot password?</a></label>
                    {{Form::submit('login',['id' => 'submit'])}}
                </div>
            {{Form::close()}}
        </div>

         <div>
            @if(Session::has('flash_message'))
                <p>{{Session::get('flash_message')}}</p>
            @endif
        </div>
        <div class="new-customer">
               {{Form::open(['route' => 'frontend.auth.register'])}}

                <div class="customer">
                    <h5>New Customers</h5>
                    {{Form::label('title','Title')}}
                    <div class="select">
                        {{Form::select('title', array(''=>'Select Type','Mr' => 'Mr','Mrs' => 'Mrs'),null,['id' => 'title'])}}
                        {{$errors->first('title','<span class=error>:message</span>')}}
                    </div>
                    {{Form::label('firstname','First Name')}}
                    {{Form::input('text', 'firstname', null, ['id' => 'firstname'])}}
                    {{$errors->first('firstname','<span class=error>:message</span>')}}

                    {{Form::label('surname')}}
                    {{Form::input('text', 'surname', null, ['id' => 'surname'])}}
                    {{$errors->first('surname','<span class=error>:message</span>')}}

                    {{Form::label('company')}}
                    {{Form::input('text', 'company', null, ['id' => 'company'])}}
                    {{$errors->first('company','<span class=error>:message</span>')}}

                    {{Form::label('emailaddress','Email Address')}}
                    {{Form::email('email',null, ['id' => 'emailaddress'])}}
                    {{$errors->first('email','<span class=error>:message</span>')}}

                    {{Form::label('password')}}
                    {{Form::input('password', 'password', null, ['id' => 'password'])}}
                    {{$errors->first('password','<span class=error>:message</span>')}}

                    {{Form::label('password_confirmation','Confirm Password')}}
                    {{Form::input('password', 'password_confirmation', null, ['id' => 'password_confirmation'])}}
                    {{$errors->first('password_confirmation','<span class=error>:message</span>')}}

                    {{Form::label('country','Select Your Country')}}
                    <div class="select">
                        {{Form::select('country',array(''=>'Select country','United States' => 'United States','Canada' => 'Canada','Afghanistan' => 'Afghanistan', 'Albania' => 'Albania', 'Algeria' => 'Algeria', 'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra', 'Angola' => 'Angola', 'Anguilla' => 'Anguilla', 'Antarctica' => 'Antarctica', 'Antigua and or Barbuda' => 'Antigua and or Barbuda', 'Argentina' => 'Argentina', 'Armenia' => 'Armenia', 'Aruba' => 'Aruba', 'Australia' => 'Australia', 'Austria' => 'Austria', 'Azerbaijan' => 'Azerbaijan', 'Bahamas' => 'Bahamas', 'Bahrain' => 'Bahrain', 'Bangladesh' => 'Bangladesh', 'Barbados' => 'Barbados', 'Belarus' => 'Belarus', 'Belgium' => 'Belgium', 'Belize' => 'Belize', 'Benin' => 'Benin', 'Bermuda' => 'Bermuda', 'Bhutan' => 'Bhutan', 'Bolivia' => 'Bolivia', 'Bosnia and Herzegovina' => 'Bosnia and Herzegovina','Botswana' => 'Botswana', 'Bouvet Island' => 'Bouvet Island', 'Brazil' => 'Brazil','British lndian Ocean Territory' => 'British lndian Ocean Territory', 'Brunei Darussalam' => 'Brunei Darussalam', 'Bulgaria' => 'Bulgaria', 'Burkina Faso' => 'Burkina Faso', 'Burundi' => 'Burundi', 'Cambodia' => 'Cambodia', 'Cameroon' => 'Cameroon', 'Cape Verde' => 'Cape Verde', 'Cayman Islands' => 'Cayman Islands', 'Central African Republic' => 'Central African Republic', 'Chad' => 'Chad', 'Chile' => 'Chile', 'China' => 'China', 'Christmas Island' => 'Christmas Island', 'Cocos' => 'Cocos', 'Colombia' => 'Colombia', 'Comoros' => 'Comoros', 'Congo' => 'Congo', 'Cook Islands' => 'Cook Islands', 'Costa Rica' => 'Costa Rica', 'Croatia' => 'Croatia', 'Cuba' => 'Cuba', 'Cyprus' => 'Cyprus', 'Czech Republic' => 'Czech Republic', 'Denmark' => 'Denmark', 'Djibouti' => 'Djibouti', 'Dominica' => 'Dominica', 'Dominican Republic' => 'Dominican Republic', 'East Timor' => 'East Timor', 'Ecudaor' => 'Ecudaor', 'Egypt' => 'Egypt', 'El Salvador' => 'El Salvador', 'Equatorial Guinea' => 'Equatorial Guinea', 'Eritrea' => 'Eritrea', 'Estonia' => 'Estonia', 'Ethiopia' => 'Ethiopia', 'Falkland Islands' => 'Falkland Islands', 'Faroe Islands' => 'Faroe Islands', 'Fiji' => 'Fiji', 'Finland' => 'Finland', 'France' => 'France', 'France, Metropolitan' => 'France, Metropolitan', 'French Guiana' => 'French Guiana', 'French Polynesia' => 'French Polynesia', 'French Southern Territories' => 'French Southern Territories', 'Gabon' => 'Gabon', 'Gambia' => 'Gambia', 'Georgia' => 'Georgia', 'Germany' => 'Germany', 'Ghana' => 'Ghana', 'Gibraltar' => 'Gibraltar', 'Greece' => 'Greece', 'Greenland' => 'Greenland', 'Grenada' => 'Grenada', 'Guadeloupe' => 'Guadeloupe', 'Guam' => 'Guam', 'Guatemala' => 'Guatemala', 'Guinea' => 'Guinea', 'Guinea-Bissau' => 'Guinea-Bissau', 'Guyana' => 'Guyana', 'Haiti' => 'Haiti', 'Heard and Mc Donald Islands' => 'Heard and Mc Donald Islands', 'Honduras' => 'Honduras', 'Hong Kong' => 'Hong Kong', 'Hungary' => 'Hungary', 'Iceland' => 'Iceland', 'India' => 'India', 'Indonesia' => 'Indonesia', 'Iran' => 'Iran', 'Iraq' => 'Iraq', 'Ireland' => 'Ireland', 'Israel' => 'Israel', 'Italy' => 'Italy', 'Ivory Coast' => 'Ivory Coast', 'Jamaica' => 'Jamaica', 'Japan' => 'Japan', 'Jordan' => 'Jordan', 'Kazakhstan' => 'Kazakhstan', 'Kenya' => 'Kenya', 'Kiribati' => 'Kiribati', 'Korea' => 'Korea, Democratic People\'s Republic of', 'Korea' => 'Korea, Republic of', 'Kuwait' => 'Kuwait', 'Kyrgyzstan' => 'Kyrgyzstan', 'Lao People' => 'Lao People\'s Democratic Republic', 'Latvia' => 'Latvia', 'Lebanon' => 'Lebanon', 'Lesotho' => 'Lesotho', 'Liberia' => 'Liberia', 'Libyan Arab Jamahiriya' => 'Libyan Arab Jamahiriya', 'Liechtenstein' => 'Liechtenstein', 'Lithuania' => 'Lithuania', 'Luxembourg' => 'Luxembourg', 'Macau' => 'Macau', 'Macedonia' => 'Macedonia', 'Madagascar' => 'Madagascar', 'Malawi' => 'Malawi', 'Malaysia' => 'Malaysia', 'Maldives' => 'Maldives', 'Mali' => 'Mali', 'Malta' => 'Malta', 'Marshall' => 'Marshall Islands', 'Martinique' => 'Martinique', 'Mauritania' => 'Mauritania', 'Mauritius' => 'Mauritius', 'Mayotte' => 'Mayotte', 'Mexico' => 'Mexico', 'Micronesia' => 'Micronesia, Federated States of', 'Moldova' => 'Moldova, Republic of', 'Monaco' => 'Monaco', 'Mongolia' => 'Mongolia', 'Montserrat' => 'Montserrat', 'Morocco' => 'Morocco', 'Mozambique' => 'Mozambique', 'Myanmar' => 'Myanmar', 'Namibia' => 'Namibia', 'Nauru' => 'Nauru', 'Nepal' => 'Nepal', 'Netherlands' => 'Netherlands', 'Netherlands Antilles' => 'Netherlands Antilles', 'New Caledonia' => 'New Caledonia', 'New Zealand' => 'New Zealand', 'Nicaragua' => 'Nicaragua', 'Niger' => 'Niger', 'Nigeria' => 'Nigeria', 'Niue' => 'Niue', 'Norfork' => 'Norfork Island', 'Northern Mariana Islands' => 'Northern Mariana Islands', 'Norway' => 'Norway', 'Oman' => 'Oman', 'Pakistan' => 'Pakistan', 'Palau' => 'Palau', 'Panama' => 'Panama', 'Papua New Guinea' => 'Papua New Guinea', 'Paraguay' => 'Paraguay', 'Peru' => 'Peru', 'Philippines' => 'Philippines', 'Pitcairn' => 'Pitcairn', 'Poland' => 'Poland', 'Portugal' => 'Portugal', 'Puerto Rico' => 'Puerto Rico', 'Qatar' => 'Qatar', 'Reunion' => 'Reunion', 'Romania' => 'Romania', 'Russian Federation' => 'Russian Federation', 'Rwanda' => 'Rwanda', 'Saint Kitts and Nevis' => 'Saint Kitts and Nevis', 'Saint Lucia' => 'Saint Lucia', 'aint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines', 'Samoa' => 'Samoa', 'San Marino' => 'San Marino', 'Sao Tome and Principe' => 'Sao Tome and Principe', 'Saudi Arabia' => 'Saudi Arabia', 'Senegal' => 'Senegal', 'Seychelles' => 'Seychelles', 'Sierra Leone' => 'Sierra Leone', 'Singapore' => 'Singapore', 'Slovakia' => 'Slovakia', 'Slovenia' => 'Slovenia', 'Solomon Islands' => 'Solomon Islands', 'Somalia' => 'Somalia', 'South Africa' => 'South Africa', 'South Georgia South Sandwich Islands' => 'South Georgia South Sandwich Islands', 'Spain' => 'Spain', 'Sri Lanka' => 'Sri Lanka', 'St. Helena' => 'St. Helena', 'St. Pierre and Miquelon' => 'St. Pierre and Miquelon', 'Sudan' => 'Sudan', 'Suriname' => 'Suriname', 'Svalbarn and Jan Mayen Islands' => 'Svalbarn and Jan Mayen Islands', 'Swaziland' => 'Swaziland', 'Sweden' => 'Sweden', 'Switzerland' => 'Switzerland', 'Syrian Arab Republic' => 'Syrian Arab Republic', 'Taiwan' => 'Taiwan', 'Tajikistan' => 'Tajikistan', 'Tanzania' => 'Tanzania, United Republic of', 'Thailand' => 'Thailand', 'Togo' => 'Togo', 'Tokelau' => 'Tokelau', 'Tonga' => 'Tonga', 'Trinidad and Tobago' => 'Trinidad and Tobago', 'Tunisia' => 'Tunisia', 'Turkey' => 'Turkey', 'Turkmenistan' => 'Turkmenistan', 'Turks and Caicos Islands' => 'Turks and Caicos Islands', 'Tuvalu' => 'Tuvalu', 'Uganda' => 'Uganda', 'Ukraine' => 'Ukraine', 'United Arab Emirates' => 'United Arab Emirates', 'United Kingdom' => 'United Kingdom', 'United States minor outlying islands' => 'United States minor outlying islands', 'Uruguay' => 'Uruguay', 'Uzbekistan' => 'Uzbekistan', 'Vanuatu' => 'Vanuatu', 'Vatican City State' => 'Vatican City State', 'Venezuela' => 'Venezuela', 'Vietnam' => 'Vietnam', 'Virigan Islands' => 'Virigan Islands (British)', 'Virgin Islands (U.S.)' => 'Virgin Islands (U.S.)', 'Wallis and Futuna Islands' => 'Wallis and Futuna Islands', 'Western Sahara' => 'Western Sahara', 'Yemen' => 'Yemen','Yugoslavia' => 'Yugoslavia', 'Zaire' => 'Zaire', 'Zambia' => 'Zambia', 'Zimbabwe' => 'Zimbabwe'),null,['id' => 'country'])}}
                    </div>
                    {{$errors->first('country','<span class=error>:message</span>')}}
                    <div class="check">
                        {{Form::checkbox('registerCheckbox',null,false)}}
                        <span class="agree">I agree to the <a href="#">Terms & Conditions</a></span>
                    </div>
                    {{$errors->first('registerCheckbox','<span class=error>:message</span>')}}
                    {{Form::submit('Register',['id' => 'submit'])}}
                </div>
            {{Form::close()}}
            <div>
                @if(Session::has('flash_message'))
                    <p>{{Session::get('flash_message')}}</p>
                @endif
            </div>
            
        </div>

    </div>
@include('partials.footer')