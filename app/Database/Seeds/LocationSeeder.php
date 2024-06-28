<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Location\CountryModel;
use App\Models\Location\RegionModel;
use App\Models\Location\SubregionModel;
use App\Models\Location\CityModel;

class LocationSeeder extends Seeder
{


    public function run()
    {
        // Instantiate models
        $countryModel = new CountryModel();
        $regionModel = new RegionModel();
        $subregionModel = new SubregionModel();
        $cityModel = new CityModel();

        // Check if country exists and insert if not
        $country = $countryModel->where('country_name', 'Lebanon')->first();
        if (!$country) {
            $countryId = $countryModel->insert(['country_name' => 'Lebanon', 'country_code' => '+961']);
        } else {
            $countryId = $country->country_id;
        }

        // Regions, Subregions, and Cities Data
        $locations = [
            [
                'region_name' => 'Akkar Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Jouma', 'cities' =>
                        [
                            'Aaiyat', 'Ain Yaaqoub', 'Akkar al-Atika', 'Beino - Qboula', 'Beit Mellat', 'Bezbina', 'Borj', 'Chakdouf', 'Chittaha', 'Dahr Laissineh', 'Dawra', 'Doura, Akkar', 'Gebrayel', 'Ilat', 'Jebrayel', 'Memnaa', 'Rahbeh', 'Tachaa', 'Tikrit'
                        ]
                    ],
                    [
                        'subregion_name' => 'Dreib', 'cities' =>
                        [
                            'Aamaret El Baykat', 'Aaouainat', 'Ain Ez Zayt', 'Ain Tinta', 'Al-Furaydis', 'Al-Qoubaiyat', 'Andaket', 'Aydamun', 'Berbara', 'Bireh', 'Chadra', 'Charbila', 'Cheikh Aayach', 'Cheikhlar', 'Daghleh', 'Dahr El Qanbar', 'Daoussa - Baghdadi', 'Debbabiyeh', 'Deir Jannine', 'Dibbabiye', 'Douair Aadouiyeh', 'El Hedd', 'El Qorne', 'Ghazaleh', 'Haouchab', 'Haytla', 'Kfar Harra', 'Kherbet Char', 'Khirbet Daoud', 'Kouachra', 'Machta Hassan', 'Menjez', 'Nahriyeh - Boustane El Herch', 'Naoura', 'Qarha', 'Qochloq', 'Qraiyat', 'Rihaniyeh', 'Rmah', 'Sarar', 'Sfinet Ed Drayb', 'Sindianet Zeidan', 'Tall Hmayra', 'Tleil', 'Wadi El Haour'
                        ]
                    ],
                    [
                        'subregion_name' => 'Qaitea', 'cities' =>
                        [
                            'Aayoun El Ghizlane', 'Ain El Zehab', 'Bebnine', 'Beit Ayoub', 'Beit El Haouch', 'Beit Younes', 'Berkail', 'Borj El Aarab', 'Bqerzla', 'Bzal', 'Chane', 'Deir Dalloum', 'Denbo', 'Fneidik', 'Habchit', 'Houaich', 'Hrar', 'Jdaidet El Qaitea', 'Karkaf', 'Kherbet El Jord', 'Mahmra', 'Majdala', 'Mar Touma', 'Mbarkiyeh', 'Mish Mish', 'Ouadi Ej Jamous', 'Qabeit', 'Qardaf', 'Qloud El Baqieh', 'Sayssouq', 'Sfinet El Qayteaa', 'Wadi Jamous', 'Zouq El Hassineh', 'Zouq El Hbalsa', 'Zouq Haddara'
                        ]
                    ],
                    [
                        'subregion_name' => 'Wadi Khaled', 'cities' =>
                        [
                            'Aarab Jourmnaya', 'Al-Kalkha', 'Al-Mahatta', 'Al-Ramah', 'Al-Saed', 'Amayer', 'Amriya', 'Awade', 'Baaliyah', 'Bani Sakhr', 'Bqaiaa', 'Dabadeb', 'El Majdal', 'Fard', 'Harb Ara', 'Hunaider', 'Kanisah', 'Karm Zabdin', 'Khat El Batrol', 'Khorab el Haiyat', 'Knaïssé', 'Machta Hammoud', 'Mqaible', 'Qal‘at al Burj', 'Rajm Beit Khalaf', 'Rajm Issa', 'Rejm Beït Housseïn'
                        ]
                    ],
                    [
                        'subregion_name' => 'Jabal Akroum', 'cities' =>
                        [
                            'Akroum', 'Basateen', 'Kfartoun', 'Mrah el Khaoukh', 'Mwanseh', 'Qenia', 'Sahleh'
                        ]
                    ],
                    [
                        'subregion_name' => 'Cheft', 'cities' =>
                        [
                            'Aadbel', 'Arqa', 'Beit El Hajj', 'Beit Ghattas', 'Cheikh Mohammad', 'Cheikh Taba', 'Hayzouq', 'Hokr ech Cheikh Taba', 'Jdaidet', 'Karm Aasfour', 'Khreibet Ej Jindi', 'Koucha', 'Kroum Aarab', 'Machha', 'Mazraat Baldeh', 'Mechilhat Hakour', 'Miniara', 'Nfisseh', 'Qantara', 'Souaisset', 'Zawarib'
                        ],
                    ],
                    [
                        'subregion_name' => 'As-Sahel', 'cities' =>
                        [
                            'Aabboudiye', 'Al Kanisa', 'Arida', 'Bellanet el Hissa', 'Cheikh Zennad', 'Darine', 'Hisah', 'Hokr Ed-Dahri', 'Kfar Melki', 'Massoudieh', 'Qaabrîne', 'Qleiaat', 'Qoubbet Chamra', 'Saadine', 'Sammaqiyeh', 'Tal Bibi', 'Talhabira', 'Tall Aabbas El Gharbi', 'Tall Aabbas El Sharqi', 'Tall Bireh', 'Tall Meaayane'
                        ]
                    ],
                ]
            ],
            [
                'region_name' => 'Baalbek-Hermel Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Baalbek', 'cities' =>
                        [
                            'Ain', 'Ainata', 'Arsal', 'Baalbek', 'Barka', 'Bednayel', 'Bechwat', 'Beit Chama - Aaqidiyeh', 'Brital', 'Btadhi', 'Bodai', 'Chaat', 'Chlifa', 'Chmestar - Gharbi Baalbeck', 'Deir el Ahmar', 'Douriss', 'Fakiha - Jdeydeh', 'Fleweh', 'Hadath Baalbek', 'Hallanieh', 'Harbata', 'Hizzine', 'Hlabta', 'Hosh Barada', 'Hosh el Rafika', 'Hosh Snid', 'Haouch Tall Safiyeh', 'Iaat', 'Jabbouleh', 'Janta', 'Jebaa', 'Jdeide', 'Kfar Dane', 'Kasarnaba', 'Khodr', 'Khraibeh', 'Kneisseh', 'Laat', 'Labweh', 'Majdloun', 'Mikna', 'Nabi Chit', 'Nabi Othman', 'Nahleh', 'Qaa', 'Qarha', 'Ram - Jbenniyeh', 'Ras Baalbek', 'Ras el Hadis', 'Saayde', 'Seriine el Fawka', 'Seriine el Tahta', 'Talya', 'Taraya', 'Taybeh', 'Temnin el Fawka', 'Temnine Et Tahta', 'Tfail', 'Wadi Faara', 'Yammouneh', 'Younine'
                        ]
                    ],
                    [
                        'subregion_name' => 'Hermel', 'cities' =>
                        [
                            'Charbine El Hermel', 'Chouaghir Et Tahta - Chouaghir El Faouqa', 'Fissane', 'Hermel', 'Jouar el Hachich', 'Kharayeb', 'Kouakh', 'Mazraat Sejoud', 'Qasr'
                        ]
                    ],
                ]
            ],
            [
                'region_name' => 'Beirut Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Beirut', 'cities' =>
                        [
                            'Badaro', 'Achrafieh', 'Beirut Central District', 'Hamra Street', 'Mazraa District', 'Raouché (including Corniche Beirut)', 'Bourj Hammoud', 'Bourj el-Barajneh', 'Dahieh', 'Chyah', 'Haret Hreik'
                        ]
                    ]
                ],
            ],
            [
                'region_name' => 'Beqaa Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Rashaya', 'cities' =>
                        [
                            'Ain Arab', 'Ain Ata', 'Ain Harcha', 'Akabeh', 'Ayha', 'Ayta el Fekhar', 'Bakifa', 'Bakka', 'Beit Lahia', 'Bireh', 'Daher el Ahmar', 'Deir El Aachayer', 'Helwah', 'Hoch', 'Kaukaba', 'Kfar Danis', 'Kfarfouk', 'Kfarmechki (including Nebi Safa)', 'Kherbet Rouha', 'Majdel Balhiss', 'Mdoukha', 'Mhaydseh', 'Rashaya', 'Al-Rafid', 'Tannoura', 'Yanta'
                        ]
                    ],
                    [
                        'subregion_name' => 'Western Beqaa', 'cities' =>
                        [
                            'Aana', 'Ain Zebdeh', 'Aitanite', 'Al Manara', 'Al Rafid', 'Baaloul', 'Bab Maraa', 'Chabraqiyet Aammiq', 'Chabraqiyet Tabet', 'Dakouh', 'Deir Ain Jaouzeh', 'Deir Tahnich', 'Ghazzeh', 'Haouch Aammiq', 'Haouch al Saalouk', 'Haouch El Saiyad', 'Haoush al Haremma', 'Kamed El Laouz', 'Khiara', 'Lala', 'Libbaya', 'Mansourah District', 'Marj, Lebanon', 'Mazraat El Chmis', 'Meidoun', 'Nasrieyh', 'Tal El Akhdar', 'Tal Zaazaa', 'Tal Znoub', 'Rawda', 'Saghbine', 'Sohmor', 'Sultan Yaacoub Tahta', 'Sultan Yaacoub Fawqa', 'Yohmor', 'Zilaya', 'Machghara', 'Joub Jannine', 'Qaraoun', 'Kafraiya', 'Kherbet Qanafar', 'Dahr El Ahmar'
                        ]
                    ],
                    [
                        'subregion_name' => 'Zahlé', 'cities' =>
                        [
                            'Ali an Nahri', 'Anjar', 'Barelias', 'Jdita', 'Majdal Anjar', 'Qabb Ilyas', 'Rayak', 'Saadnayel', 'Taalabaya', 'Zahlé', 'Qâa er Rîm'
                        ]
                    ],
                ]
            ],
            [
                'region_name' => 'Keserwan-Jbeil Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Byblos', 'cities' => [
                            'Aabaydat', 'Almat el-Chmaliyeh', 'Almat el-Jnoubiyeh', 'Amsheet', 'Annaya', 'Aqoura', 'Adonis', 'Afqa', 'Ain ed-Delbeh', 'Ain el-Ghouaybeh', 'Ain Jrain', 'Ain Kfaa', 'Bazyoun', 'Bchilleh', 'Beer el-Hit', 'Behdidat', 'Bejjeh', 'Bekhaaz', 'Berbara', 'Beithabbak', 'Bichtlida', 'Bentaël', 'Birket Hjoula', 'Blat', 'Boulhos', 'Brayj', 'Byblos', 'Chatine', 'Chikhane', 'Chmout', 'Edde', 'Ehmej', 'Fatreh', 'Ferhet', 'Fghal', 'Fidar', 'Ghabat', 'Ghalboun', 'Gharzouz', 'Ghorfine', 'Habil', 'Halat', 'Haqel', 'Hay el-Arabeh', 'Hbaline', 'Hboub', 'Hdayneh', 'Hjoula', 'Hosrayel', 'Hsarat', 'Hsoun', 'Jaj', 'Janneh', 'Jeddayel', 'Jenjol', 'Jlisseh', 'Jouret El Qattine', 'Kafr', 'Kfar Baal', 'Kfar Hitta', 'Kfar Kiddeh', 'Kfar Masshoun', 'Kfar Qouas', 'Kfoun', 'Laqlouq', 'Lassa', 'Lehfed', 'Maad', 'Majdel', 'Marj', 'Mastita', 'Mayfouq', 'Mazarib', 'Mazraat es-Siyad', 'Mechane', 'Mghayreh', 'Mish Mish', 'Mounsef', 'Nahr Ibrahim', 'Qahmez', 'Qartaba', 'Qartaboun', 'Qorqraiya', 'Ram', 'Ramout', 'Ras Osta', 'Rihaneh', 'Seraaita', 'Souaneh', 'Tartej', 'Tourzaiya', 'Yanouh', 'Zebdine'
                        ]
                    ],
                    [
                        'subregion_name' => 'Keserwan', 'cities' => [
                            'Adma wa Dafneh', 'Ain el-Rihaneh', 'Aintoura', 'Ajaltoun', 'Aramoun', 'Ashqout', 'Azra', 'Ballouneh', 'Batha', 'Bkerké', 'Bqaatouta', 'Bzoummar', 'Chahtoul-Jouret Mhad', 'Chnaniir', 'Daraoun', 'Daraya', 'Dlebta', 'Faitroun', 'Faraya', 'Fatqa', 'Ghazir', 'Ghbaleh', 'Ghidras', 'Ghineh', 'Ghosta', 'Harissa-Daraoun', 'Herharaya', 'Hrajel', 'Jdaidet Ghazir', 'Jeita', 'Jouret Bedran', 'Jouret el-Termos', 'Kaslik', 'Kfar Dibiane', 'Kfar Yassine', 'Okaibe', 'Qattine', 'Qleiat', 'Maarab', 'Mayrouba', 'Rayfoun', 'Safra', 'Sahel Alma', 'Sarba', 'Sehaileh', 'Tabarja', 'Yahchouch', 'Zouk Mikael', 'Zouk Mosbeh'
                        ]
                    ],
                ],
            ],
            [
                'region_name' => 'Mount Lebanon Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Aley', 'cities' => [
                            'Abey', 'Aghmid', 'Ain Dara', 'Aïn-El-Jdeidé', 'Aïn-Enoub', 'Aïn-Rommané', 'Aïn Drafile', 'Aïn El-Halzoune', 'Aïn Ksour', 'Ain Saideh', 'Aïn Sofar', 'Aïn Traz', 'Aïnab', 'Aïtate', 'Aley', 'Aramoun', 'Baïssour', 'Baouarta', 'Bchamoune', 'Bdédoune', 'Bedghane', 'Bhamdoun', 'Bhouara', 'Bisrine', 'Bkhichtay', 'Bleibel', 'Bmakkine', 'Bmehraï', 'Bouzridé', 'Bsous', 'Btallaoun', 'Btater', 'Bteezanieh', 'Chamlane', 'Chanay', 'Sharoun', 'Chartoun', 'Chouaifat Amroussyat', 'Chouaifat Oumara', 'Chouaifat Qobbat', 'Dakkoun', 'Deir-Koubel', 'Dfoun', 'Douair El-Roummane', 'EL-Azouniyeh', 'El-Bennayé', 'El-Fsaïkine', 'El-Ghaboun', 'El-Kahalé', 'El-Kamatiyeh', 'El-Mansouriyeh et Aïn-El-Marge', 'El-Mechrefeh', 'El-Mreijate', 'El-Ramliyeh', 'El-Rejmeh', 'Habramoun', 'Houmale', 'Kaïfoun', 'Kfar-Aammay', 'Kfar Matta', 'litige', 'Maasraïti', 'Majdel Baana-Sawfar', 'Mazraet El-Nahr', 'Mchakhté', 'Mejdlaya', 'Rechmaya', 'Remhala', 'Roueissat El-Naaman', 'Sarahmoul', 'Selfaya', 'Souk-El-Gharb', 'Taazanieh'
                        ]
                    ],
                    [
                        'subregion_name' => 'Baabda', 'cities' => [
                            'Abadieh', 'Ain el Remmaneh', 'Araya', 'Arbiniyeh', 'Baabda', 'Baalchmay', 'Betchay', 'Bmariam', 'Btekhnay', 'Borj Al Barajneh', 'Chebanieh', 'Chiyah', 'Falougha', 'Jouar el-Haouz', 'Furn el Chebbak', 'Ghobeiry', 'Hadath', 'Hammana', 'Haret Hreik', 'Haret el Sitt', 'Hazmieh', 'Hlaliyeh', 'Jamhour', 'Kfarshima', 'Kfar Selouane', 'Khraybeh', 'Knaisseh', 'Kortada', 'Krayyeh', 'Ksaibe', 'Laylakeh', 'Qalaa', 'Qarnayel', 'Ras el-Matn', 'Sebnay', 'Tarchich', 'Tohwita', 'Wadi Chahrour', 'Yarze', 'Qoubbei'
                        ]
                    ],
                    [
                        'subregion_name' => 'Chouf', 'cities' => [
                            'Ainbal', 'Ain Zhalta', 'Ammatour', 'Aanouth', 'Baadarâne', 'Baakline', 'Barja', 'Barouk', 'Batloun', 'Beitedine', 'Bourjain', 'Brih', 'Bsaba', 'Chhime', 'Dahr El Maghara', 'Damour', 'Daraya', 'Deir el Qamar', 'Dibbiyeh', 'Gharife', 'Haret Jandal', 'Fouara', 'Jahlieh', 'Jdaideh', 'Jiyyeh', 'Joun', 'Kahlouniye', 'Kfarfakoud', 'Moukhtara', 'Na\'ameh', 'Niha Chouf', 'Rmeileh', 'Serjbel', 'Shheem', 'Zaarourieh'
                        ]
                    ],
                    [
                        'subregion_name' => 'Matn/Metn', 'cities' =>  [
                            'Ain Aar', 'Ain el Safssaf', 'Ain el Sendianeh', 'Ain Saadeh', 'Aintoura', 'Amaret Chalhoub', 'Antelias', 'Aoukar', 'Al-Ayroun', 'Baabdat', 'Baskinta', 'Bauchrieh', 'Beit Chabab', 'Beit el Chaar', 'Beit el Kekko', 'Beit Mery', 'Bhersaf', 'Biakout', 'Bikfaya', 'Bkenneya', 'Bourj Hammoud', 'Broummana', 'Bsalim', 'Bteghrine', 'Chaouiyeh', 'Choueir', 'Daher al Hosein', 'Dahr el Sawan', 'Daychounieh', 'Dbayeh', 'Dekwaneh', 'Dik El Mehdi', 'Dhour El Choueir', 'Dora', 'Douar', 'Fanar', 'Ghabeh', 'Ghabet Bologna', 'Hadirah', 'Haret al Ballaneh', 'Haret ech Cheikh', 'Hemlaya', 'Hbous', 'Jal el Dib', 'Jdeideh', 'Jouar', 'Jouret el Ballout', 'Kaakour', 'Kfarakab', 'Kfartay', 'Khenchara', 'Majdel Tarchich', 'Majzoub', 'Mansourieh', 'Mar Chaaya', 'Mar Michael Bnabil', 'Mar Moussa', 'Mar Roukouz', 'Marjaba', 'Mazraat Yachouh', 'Mchikha', 'Mezher', 'Mhaydseh', 'Mkalles', 'Mrouj', 'Mtaileb', 'Mtein', 'Mzekkeh', 'Nabay', 'Naccache', 'Ouyoun', 'Qonaytrah', 'Qonnabat Broummana', 'Qornet Shehwan', 'Rabieh', 'Roumieh', 'Sakiyat al Mesek', 'Sed el Bauchrieh', 'Sin el Fil', 'Sfaileh', 'Wata el Mrouj', 'Zalka', 'Zarooun', 'Zakrit', 'Zouk al Khrab'
                        ]
                    ],
                ]
            ],
            [
                'region_name' => 'Nabatieh Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Bint Jbeil', 'cities' =>
                        [
                            'Aynata', 'Aayta Ech Chaab', 'Aayta Ej Jabal (Zott)', 'Ain Ebel', 'Aaytaroun',
                            'At Tiri', 'Baraachit', 'Beit Lif', 'Beit Yahoun', 'Bint Jbeil', 'Borj Qalaouiyeh',
                            'Debl', 'Deir Ntar', 'Froun', 'Ghandouriyeh', 'Haddatha', 'Hanine', 'Hariss',
                            'Jmaijmeh', 'Kafra', 'Kfar Dounine', 'Khirbet Selm', 'Kounine', 'Maroun Al Ras',
                            'Qalaouiyeh', 'Qaouzah', 'Rachaf', 'Ramiyeh (Bent Jbayl)', 'Rmaych', 'Safad El Battikh',
                            'Salhana', 'Shaqra', 'Soultaniyeh', 'Srobbine', 'Tibnine', 'Yaroun', 'Yater'
                        ]
                    ],
                    [
                        'subregion_name' => 'Hasbaya', 'cities' =>
                        [
                            'Ain Qinia', 'Shebaa', 'Chouaya', 'Fardis', 'Halta', 'Hebbariye', 'Kaukaba',
                            'Kfarchouba', 'Kfarhamam', 'Kfeir', 'Khalouat', 'Mimess', 'Rachaya Al Foukhar', 'Wazzani'
                        ]
                    ],
                    [
                        'subregion_name' => 'Marjeyoun', 'cities' => [
                            'Aadchit', 'Alman', 'Bani Haiyyan', 'Blat', 'Blida', 'Deir Mimas', 'Deir Siriane',
                            'Dibbine', 'Hula', 'Ibl al-Saqi', 'Kafr Kila', 'Khiam', 'Majdel Selm', 'Markaba',
                            'Meiss Ej Jabal', 'Muhajbib', 'Odaisseh', 'Qabrikha', 'Qantara', 'Qlaiaa', 'Qoussair',
                            'Rab El Thalathine', 'Talloussa', 'Tayibe'
                        ]
                    ],
                    [
                        'subregion_name' => 'Nabatieh', 'cities' =>
                        [
                            'Qaaqaait Al Jisr', 'Ansar', 'Aedsheet', 'Ain Qana', 'Ain Boswar', 'Aldawair', 'Arab Saleem',
                            'Chouqin', 'Der Al Zahrani', 'Doueir', 'Ebba', 'Habboush', 'Harouf', 'Jarjouh', 'Jbaa',
                            'Jibcheet', 'Kfarfila', 'Kfour, Nabatieh', 'Kfarjouz', 'Kafra', 'Kfar Remen', 'Kfarsseer',
                            'Houmeen', 'Kfar Tebneet', 'Marwania', 'Mayfadoun', 'Schhour', 'Zifta', 'Kaoutariyet Al Siyad',
                            'Toul', 'Nabatiye al-Fawqa', 'Sharqia', 'Zawtar el charkiyeh', 'Zibdeen', 'Braikeh', 'Qusayba'
                        ],
                    ],
                ]
            ],
            [
                'region_name' => 'North Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Batroun', 'cities' =>

                        [
                            'Aabdelli', 'Aabrine', 'Aalali', 'Aaoura', 'Aartiz', 'Asia', 'Batroun', 'Basbina', 'Bchaaleh',
                            'Beit Chlala', 'Beit Kassab', 'Bijdarfil', 'Boqsmaiya', 'Chatine', 'Chekka', 'Chibtine', 'Daael',
                            'Dahr Abi Yaghi', 'Darya', 'Deir Billa', 'Douma', 'Douq', 'Eddeh', 'Ftahat', 'Ghouma', 'Hadtoun',
                            'Hamat', 'Harbouna', 'Hardine', 'Heri', 'Hilta', 'Ijdabra', 'Jebla', 'Jrabta', 'Jran', 'Kandoula',
                            'Fadous', 'Kfar Chleymane', 'Kfar Hatna', 'Kfar Hay', 'Kfar Hilda', 'Kfar Shlaimane', 'Kfifane',
                            'Kfour El Arabi', 'Koubba', 'Kour', 'Madfoun', 'Mehmarch', 'Mar Mama', 'Masrah', 'Mrah Chdid',
                            'Mrah Ez Ziyat', 'Nahla', 'Niha, Batroun', 'Ouajh El Hajar', 'Ouata Houb', 'Qandola', 'Racha',
                            'Rachana', 'Rachkida', 'Ram, Batroun', 'Ras Nahhach', 'Selaata', 'Sghar', 'Smar Jbeil', 'Sourat',
                            'Tannourine El Faouqa', 'Thoum', 'Toula', 'Wata Hob', 'Zane'
                        ]

                    ],
                    [
                        'subregion_name' => 'Bsharri', 'cities' =>

                        [
                            'Aabdine', 'Bane', 'Bazoun', 'Barhalyoun', 'Beit Minzer', 'Bekaa Kafra', 'Billa', 'Blaouza',
                            'Bqarqacha', 'Brisat', 'Bsharri', 'Chira', 'Dimane', 'El-Arz', 'Hadath El Jebbeh', 'Hadchit',
                            'Hasroun', 'Mazraat Assaf', 'Mazraat Bani Saab', 'Moghr El Ahwal', 'Qnat', 'Qnaywer', 'Tourza'
                        ]

                    ],
                    [
                        'subregion_name' => 'Koura', 'cities' =>
                        [
                            'Kfaraakka', 'Amioun', 'Enfeh', 'Deddeh', 'Kousba', 'Ras Maska'
                        ]
                    ],
                    [
                        'subregion_name' => 'Miniyeh-Danniyeh District', 'cities' =>
                        [
                            'Aassoun', 'Bakhoun', 'Beddawi', 'Beit El Faqs', 'Btermaz', 'Bqaa Safrine', 'Haql El Aazimeh', 'Kfar Habou', 'Khaldieh', 'Markabta', 'Miniyeh', 'Mrah Es Srayj', 'Qarsita', 'Qattine', 'Sfira', 'Sir', 'Tarane'
                        ]
                    ],
                    [
                        'subregion_name' => 'Tripoli', 'cities' =>
                        ['Tripoli', 'Al-Qalamoun', 'El-Mina']
                    ],
                    [
                        'subregion_name' => 'Zgharta', 'cities' =>
                        [
                            'Aarjes', 'Aintourine', 'Aitou', 'Alma', 'Arbet Kozhaya', 'Ardeh', 'Ashashe', 'Aslout', 'Asnoun', 'Basloukit', 'Bchennine', 'Beit Awkar', 'Beit Obeid', 'Besbeel', 'Bhairet Toula', 'Bnachii', 'Bousit', 'Daraya', 'Ehden', 'Ejbeh', 'Fraydiss', 'Haret Al Fawar', 'Harf Ardeh', 'Harf Miziara', 'Hawqa', 'Hilan', 'Houmeiss', 'Iaal', 'Jdaydeh', 'Kadrieh', 'Karahbache', 'Karmsaddeh', 'Kfardlakos', 'Kfarfou', 'Kfarhawra', 'Kfarsghab', 'Kfarshakhna', 'Kfarhata', 'Kfaryachit', 'Kfarzeina', 'Mazraat Al Nahr', 'Mazraat Al Toufah', 'Mazraat Hraikis', 'Mejdlaya', 'Miriata', 'Miziara', 'Sakhra', 'Morh Kfarsghab', 'Rachiine', 'Raskifa', 'Sebhel', 'Sereel', 'Toula', 'Zgharta'
                        ]
                    ],
                ]
            ],
            [
                'region_name' => 'South Governorate',
                'subregions' => [
                    [
                        'subregion_name' => 'Sidon', 'cities' =>
                        [
                            'Aaddoussiyeh', 'Aadloun', 'Aaqtanit', 'Ain El Delb', 'Anqoun', 'Ansariye', 'Arzai', 'Erkay', 'Babliyeh', 'Bqosta', 'Bramiyeh', 'Darb es Sim', 'Ghazieh', 'Ghassanieh', 'Hajjeh', 'Hlaliyeh', 'Jazireh', 'Kfar Beit', 'Kfar Chellal', 'Kfar Hatta', 'Kfar Melki', 'Loubieh', 'Maghdouché', 'Majdelyoun', 'Matariyyah', 'Merouaniyeh', 'Mazraat El Aousamiyyat', 'Miye ou Miye', 'Najjariyeh', 'Qaaqaaiyet El Snoubar', 'Qennarit', 'Qnaitra', 'Qraiyeh', 'Saksakiyeh', 'Salhiyeh', 'Sarafand', 'Tabbaya', 'Tanbourit', 'Zaghdraiya', 'Zeita', 'Zrarieh'
                        ]
                    ],
                    [
                        'subregion_name' => 'Jezzine', 'cities' =>
                        [
                            'Aaramta', 'Aishiya', 'Al Rihan', 'Aray', 'Azour', 'Benouati', 'Bkassine', 'Bteddine El Loqch', 'Haytoura', 'Homsiyeh', 'Jarmaq', 'Jernaya', 'Karkha', 'Kaitouly', 'Kfar Falous', 'Kfarhouna', 'Kfar Jarra', 'Lebaa', 'Louayzeh', 'Machmoucheh', 'Midane', 'Mjeydil', 'Mlikh', 'Ouadi Jezzine', 'Roum', 'Sabbah', 'Saydoun', 'Sejoud', 'Sfaray', 'Snaya'
                        ]
                    ],
                    [
                        'subregion_name' => 'Tyre', 'cities' =>
                        [
                            'Aabbassiyeh', 'Aalma ech Chaab', 'Ain Baal', 'Aitit', 'Barish', 'Bayyad', 'Bazourieh', 'Bedias', 'Boustane', 'Borj Ech Chemali', 'Borj Rahal', 'Chamaa', 'Chaitiyeh', 'Chehabiyeh', 'Chehour', 'Chihine', 'Debaal', 'Deir Aames', 'Deir Kifa', 'Deir Qanoun En Nahr', 'Halloussiyeh', 'Hanaouay', 'Jennata', 'Jibbain', 'Jwaya', 'Kneisseh', 'Maarakeh', 'Maaroub', 'Mansouri', 'Majadel', 'Majdel Zoun', 'Mahrouna', 'Marwahin', 'Naqoura', 'Qana', 'Qlaileh', 'Ras al-Ain', 'Rechknanay', 'Selaa', 'Siddikine', 'Srifa', 'Tayr Debba', 'Tayr Falsay', 'Tayr Harfa', 'Toura', 'Yarine', 'Zalloutieh', 'Zibqin'
                        ]
                    ],
                ]
            ]
        ];

        foreach ($locations as $regionData) {
            $region = $regionModel->where('region_name', $regionData['region_name'])->first();
            if (!$region) {
                $regionId = $regionModel->insert([
                    'region_name' => $regionData['region_name'],
                    'country_id' => $countryId
                ]);
            } else {
                $regionId = $region['region_id'];
            }

            foreach ($regionData['subregions'] as $subregionData) {
                $subregion = $subregionModel->where('subregion_name', $subregionData['subregion_name'])->first();
                if (!$subregion) {
                    $subregionId = $subregionModel->insert([
                        'subregion_name' => $subregionData['subregion_name'],
                        'region_id' => $regionId
                    ]);
                } else {
                    $subregionId = $subregion['subregion_id'];
                }

                foreach ($subregionData['cities'] as $cityName) {
                    $city = $cityModel->where('city_name', $cityName)->first();
                    if (!$city) {
                        $cityModel->insert([
                            'city_name' => $cityName,
                            'subregion_id' => $subregionId
                        ]);
                    }
                }
            }
        }
    }
}
