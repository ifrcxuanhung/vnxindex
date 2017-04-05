<?php
$nationals = array(
                'Afghan',
                'Albanian',
                'Algerian',
                'American',
                'Andorran',
                'Angolan',
                'Antiguans',
                'Argentinean',
                'Armenian',
                'Australian',
                'Austrian',
                'Azerbaijani',
                'Bahamian',
                'Bahraini',
                'Bangladeshi',
                'Barbadian',
                'Barbudans',
                'Batswana',
                'Belarusian',
                'Belgian',
                'Belizean',
                'Beninese',
                'Bhutanese',
                'Bolivian',
                'Bosnian',
                'Brazilian',
                'British',
                'Bruneian',
                'Bulgarian',
                'Burkinabe',
                'Burmese',
                'Burundian',
                'Cambodian',
                'Cameroonian',
                'Canadian',
                'Cape Verdean',
                'Central African',
                'Chadian',
                'Chilean',
                'Chinese',
                'Colombian',
                'Comoran',
                'Congolese',
                'Costa Rican',
                'Croatian',
                'Cuban',
                'Cypriot',
                'Czech',
                'Danish',
                'Djibouti',
                'Dominican',
                'Dutch',
                'East Timorese',
                'Ecuadorean',
                'Egyptian',
                'Emirian',
                'Equatorial Guinean',
                'Eritrean',
                'Estonian',
                'Ethiopian',
                'Fijian',
                'Filipino',
                'Finnish',
                'French',
                'Gabonese',
                'Gambian',
                'Georgian',
                'German',
                'Ghanaian',
                'Greek',
                'Grenadian',
                'Guatemalan',
                'Guinea-Bissauan',
                'Guinean',
                'Guyanese',
                'Haitian',
                'Herzegovinian',
                'Honduran',
                'Hungarian',
                'I-Kiribati',
                'Icelander',
                'Indian',
                'Indonesian',
                'Iranian',
                'Iraqi',
                'Irish',
                'Israeli',
                'Italian',
                'Ivorian',
                'Jamaican',
                'Japanese',
                'Jordanian',
                'Kazakhstani',
                'Kenyan',
                'Kittian and Nevisian',
                'Kuwaiti',
                'Kyrgyz',
                'Laotian',
                'Latvian',
                'Lebanese',
                'Liberian',
                'Libyan',
                'Liechtensteiner',
                'Lithuanian',
                'Luxembourger',
                'Macedonian',
                'Malagasy',
                'Malawian',
                'Malaysian',
                'Maldivan',
                'Malian',
                'Maltese',
                'Marshallese',
                'Mauritanian',
                'Mauritian',
                'Mexican',
                'Micronesian',
                'Moldovan',
                'Monacan',
                'Mongolian',
                'Moroccan',
                'Mosotho',
                'Motswana',
                'Mozambican',
                'Namibian',
                'Nauruan',
                'Nepalese',
                'New Zealander',
                'Nicaraguan',
                'Nigerian',
                'Nigerien',
                'North Korean',
                'Northern Irish',
                'Norwegian',
                'Omani',
                'Pakistani',
                'Palauan',
                'Panamanian',
                'Papua New Guinean',
                'Paraguayan',
                'Peruvian',
                'Polish',
                'Portuguese',
                'Qatari',
                'Romanian',
                'Russian',
                'Rwandan',
                'Saint Lucian',
                'Salvadoran',
                'Samoan',
                'San Marinese',
                'Sao Tomean',
                'Saudi',
                'Scottish',
                'Senegalese',
                'Serbian',
                'Seychellois',
                'Sierra Leonean',
                'Singaporean',
                'Slovakian',
                'Slovenian',
                'Solomon Islander',
                'Somali',
                'South African',
                'South Korean',
                'Spanish',
                'Sri Lankan',
                'Sudanese',
                'Surinamer',
                'Swazi',
                'Swedish',
                'Swiss',
                'Syrian',
                'Taiwanese',
                'Tajik',
                'Tanzanian',
                'Thai',
                'Togolese',
                'Tongan',
                'Trinidadian/Tobagonian',
                'Tunisian',
                'Turkish',
                'Tuvaluan',
                'Ugandan',
                'Ukrainian',
                'Uruguayan',
                'Uzbekistani',
                'Venezuelan',
                'Vietnamese',
                'Welsh',
                'Yemenite',
                'Zambian',
                'Zimbabwean'
        );
?>
<div class="add-research">
<h3 class="title-header"><?php trans('infomation_user') ?></h3>

    <form action="" method="post" enctype="multipart/form-data">
        <input class="submit-top" type="submit" name="save" value="<?php trans('save') ?>" />
        <!--<a class="add_research" href="<?php echo base_url().'researchers/rlist'?>"><?php trans('back') ?></a>-->
        
        <p> 
            <label>First name</label>
            <input type="text" name="first_name" value="<?php echo (isset($_POST['first_name'])) ? $_POST['first_name'] : @$infoUser[0]['first_name'] ?>" />
        </p>
        <p>
            <label>Last name</label>
            <input type="text" name="last_name" value="<?php echo (isset($_POST['last_name'])) ? $_POST['last_name'] : @$infoUser[0]['last_name'] ?>" />
        </p>
        <!--
        <p>
            <label>Email</label>
            <input type="text" name="email" value="" />
        </p>
        -->
        <p>
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : @$infoUser[0]['phone'] ?>" />
        </p>
        <p>
            <label>Date Birth</label>
            <input type="text" name="date_birth" value="<?php echo (isset($_POST['date_birth'])) ? $_POST['date_birth'] : @$infoUser[0]['date_birth'] ?>" />
        </p>
        <p>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo (isset($_POST['address'])) ? $_POST['address'] : @$infoUser[0]['address'] ?>" />
        </p>
        <p>
            <label>Website</label>
            <input type="text" name="website" value="<?php echo (isset($_POST['website'])) ? $_POST['website'] : @$infoUser[0]['website'] ?>" />
        </p>
        <p>
            <label>Nationality</label>
            <select name="nationality" class="FormValue">
                    <option value=''><?php trans('select_nationality') ?></option>
                <?php
                    foreach($nationals as $value)
                    {
                        $selected = "";
                        if(isset($_POST['nationality']))
                        {
                            if($_POST['nationality'] == $value)
                                $selected = "selected='selected'";
                        }
                        else
                        {
                            if(@$infoUser[0]['nationality'] == $value)
                                $selected = "selected='selected'";
                        } 
                        echo "<option ". $selected ." value='". $value ."'>". $value ."</option>";
                    } 
                ?>
            </select>
        </p>
        <p>
            <label>University</label>
            <input type="text" name="university" value="<?php echo (isset($_POST['university'])) ? $_POST['university'] : @$infoUser[0]['university'] ?>" />
        </p>
        <p>
            <label>Profile position</label>
            <input type="text" name="profile_position" value="<?php echo (isset($_POST['profile_position'])) ? $_POST['profile_position'] : @$infoUser[0]['profile_position'] ?>" />
        </p>
        <p>
            <label>Profile</label>
            <textarea name="profile"><?php echo (isset($_POST['profile'])) ? $_POST['profile'] : @$infoUser[0]['profile'] ?></textarea>
        </p>
        <p>
            <label>Experience</label>
            <textarea name="experience"><?php echo (isset($_POST['experience'])) ? $_POST['experience'] : @$infoUser[0]['experience'] ?></textarea>
        </p>
        <p>
            <label>Specialities</label>
            <textarea name="specialities"><?php echo (isset($_POST['specialities'])) ? $_POST['specialities'] : @$infoUser[0]['specialities'] ?></textarea>
        </p>
        <p>
            <label>Hình đại diện</label>
            <input type="file" name="upload_image" />
            <input type="hidden" name="image_user_old" value="<?php echo $infoUser[0]['image'] ?>" />
        </p>
        <?php 
            if($infoUser[0]['image'] != "")
            {
        ?>
            <p>
                <img class="image_user" src="<?php echo base_url() .'assets/upload/files/research/' . $infoUser[0]['image'] ?>" />
            </p>
        <?php } ?>
        <input type="submit" name="save" value="<?php trans('save') ?>" />
    </form>
</div>



