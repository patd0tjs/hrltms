<!-- this script should load first -->
<script>
  function check_id(){
  let warning = document.getElementById('id_warn').style;
  let id = document.getElementById('id').value;

  const usernames = [
    <?php foreach($employees as $emp):?>
    '<?= $emp['id']?>',
    <?php endforeach;?>
  ];

  if(usernames.includes(id)){
    warning.display = 'block';
  } else {
    warning.display = 'none';
  }

}
</script>

<script>
  var cities = {
	'Abra'  : [
		'Bangued','Boliney','Bucay','Bucloc','Daguioman','Danglas',
		'Dolores','La Paz','Lacub','Lagangilang','Lagayan','Langiden',
		'Licuan-Baay','Luba','Malibcong','Manabo','Peñarrubia','Pidigan',
		'Pilar','Sallapadan','San Isidro','San Juan','San Quintin','Tayum',
		'Tineg','Tubo','Villaviciosa'
		],
	'Agusan del Norte' : [
		'Buenavista','Butuan','Cabadbaran','Carmen','Jabonga','Kitcharao',
		'Las Nieves','Magallanes','Nasipit','Remedios T. Romualdez','Santiago',
		'Tubay'
		],
	'Agusan del Sur' : [
		'Bayugan','Bunawan','Esperanza','La Paz','Loreto','Prosperidad',
		'Rosario','San Francisco','San Luis','Santa Josefa','Sibagat',
		'Talacogon','Trento','Veruela'
		],
	'Aklan' : [
		'Altavas','Balete','Banga','Batan','Buruanga','Ibajay',
		'Kalibo','Lezo','Libacao','Madalag','Makato','Malay',
		'Malinao','Nabas','New Washington','Numancia','Tangalan'
		],
	'Albay' : [
		'Bacacay','Camalig','Daraga','Guinobatan','Jovellar','Legazpi',
		'Libon','Ligao','Malilipot','Malinao','Manito','Oas',
		'Pio Duran','Polangui','Rapu-Rapu','Santo Domingo','Tabaco',
		'Tiwi'
		],
	'Antique' : [
		'Anini-y','Barbaza','Belison','Bugasong','Caluya','Culasi',
		'Hamtic','Laua-an','Libertad','Pandan','Patnongon','San Jose de Buenavista',
		'San Remigio','Sebaste','Sibalom','Tibiao','Tobias Fornier','Valderrama'
		],
	'Apayao' : [
		'Calanasan','Conner','Flora','Kabugao','Luna','Pudtol',
		'Santa Marcela'
		],
	'Aurora' : [
		'Baler','Casiguran','Dilasag','Dinalungan','Dingalan','Dipaculao',
		'Maria Aurora','San Luis'
		],
	'Basilan' : [
		'Akbar','Al-Barka','Hadji Mohammad Ajul','Hadji Muhtamad','Isabela City','Lamitan',
		'Lantawan','Maluso','Sumisip','Tabuan-Lasa','Tipo-Tipo','Tuburan',
		'Ungkaya Pukan'
		],
	'Bataan' : [
		'Abucay','Bagac','Balanga','Dinalupihan','Hermosa','Limay',
		'Mariveles','Morong','Orani','Orion','Pilar','Samal',
		],
	'Batanes' : [
		'Basco','Itbayat','Ivana','Mahatao','Sabtang','Uyugan'
		],
	'Batangas' : [
		'Agoncillo','Alitagtag','Balayan','Balete','Batangas City','Bauan',
		'Calaca','Calatagan','Cuenca','Ibaan','Laurel','Lemery',
		'Lian','Lipa','Lobo','Mabini', 'Malvar','Mataas na kahoy',
		'Nasugbu','Padre Garcia','Rosario','San Jose','San Juan','San Luis',
		'San Nicolas','San Pascual','Santa Teresita','Santo Tomas','Taal',
		'Talisay','Tanauan','Taysan','Tingloy','Tuy'
		],
	'Benguet' : [
		'Atok','Baguio','Bakun','Bokod','Buguias','Itogon',
		'Kabayan','Kapangan','Kibungan','La Trinidad','Mankayan','Sablan',
		'Tuba','Tublay'
		],
	'Biliran' : [
		'Almeria','Biliran','Cabucgayan','Caibiran','Culaba','Kawayan',
		'Maripipi','Naval'
		],
	'Bohol' : [
		'Alicia','Anda','Batuan','Bilar','Candijay','Carmen',
		'Dimiao','Duero','Garcia Hernandez','Guindulman','Jagna','Sevilla',
		'Lila','Loay','Loboc','Mabini', 'Pilar','Sierra Bullones',
		'Valencia'
		],	
	'Bukidnon' : [
		'Baungon','Cabanglasan','Damulog','Dangcagan','Don Carlos','Impasugong',
		'Kadingilan','Kalilangan','Kibawe','Kitaotao','Lantapan','Libona',
		'Malaybalay','Malitbog','Manolo Fortich','Maramag', 'Pangantucan','Quezon',
		'San Fernando','Sumilao','Talakag','Valencia'
		],
	'Bulacan' : [
		'Angat','Balagtas','Baliuag','Bocaue','Bulakan','Bustos',
		'Calumpit','Doña Remedios Trinidad','Guiguinto','Hagonoy','Malolos','Marilao',
		'Meycauayan','Norzagaray','Obando','Pandi', 'Paombong','Plaridel',
		'Pulilan','San Ildefonso','San Jose del Monte','San Miguel','San Rafael','Santa Maria'
		],
	'Cagayan' : [
		'Abulug','Alcala','Allacapan','Amulung','Aparri','Baggao',
		'Ballesteros','Buguey','Calayan','Camalaniugan','Claveria','Enrile',
		'Gattaran','Gonzaga','Iguig','Lal-lo', 'Lasam','Pamplona',
		'Peñablanca','Piat','Rizal','Sanchez-Mira','Santa Ana','Santa Praxedes',
		'Santa Teresita','Santo Niño','Solana','Tuao','Tuguegarao City'
		],	
	'Camarines Norte' : [
		'Basud','Capalonga','Daet','Jose Panganiban','Labo','Mercedes',
		'Paracale','San Lorenzo Ruiz','San Vicente','Santa Elena','Talisay','Vinzons',
		],
	'Camarines Sur' : [
		'Baao','Balatan','Bato','Bombon','Buhi','Bula',
		'Cabusao','Calabanga','Camaligan','Canaman','Caramoan','Del Gallego',
		'Gainza','Garchitorena','Goa','Iriga','Lagonoy','Libmanan',
		'Lupi','Magarao','Milaor','Minalabac','Nabua','Naga',
		'Ocampo','Pamplona','Pasacao','Pili','Presentacion','Ragay',
		'Sagñay','San Fernando','San Jose','Sipocot','Siruma','Tigaon',
		'Tinambac'
		],
	'Camiguin' : [
		'Catarman','Guinsiliban','Mahinog','Mambajao','Sagay'
		],
	'Capiz' : [
		'Cuartero','Dao','Dumalag','Dumarao','Ivisan','Jamindan',
		'Maayon','Mambusao','Panay','Panitan','Pilar','Pontevedra',
		'President Roxas','Roxas City','Sapian','Sigma', 'Tapaz'
		],
	'Catanduanes' : [
		'Bagamanoc','Baras','Bato','Caramoran','Gigmoto','Pandan',
		'Panganiban','San Andres','San Miguel','Viga','Virac'
		],
	'Cavite' : [
		'Alfonso','Amadeo','Bacoor','Carmona','Cavite City','Dasmariñas',
		'General Emilio Aguinaldo','General Mariano Alvarez','General Trias','Imus','Indang','Kawit',
		'Magallanes','Maragondon','Mendez','Naic','Noveleta','Rosario',
		'Silang','Tagaytay','Tanza','Ternate','Trece Martires'
		],
	'Cebu' : [
		'Alcantara','Alcoy','Alegria','Aloguinsan','Argao','Asturias',
		'Badian','Balamban','Bantayan','Barili','Bogo','Boljoon',
		'Borbon','Carcar','Carmen','Catmon','Cebu City','Compostela',
		'Consolacion','Cordova','Daanbantayan','Dalaguete','Danao','Dumanjug',
		'Ginatilan','Lapu-Lapu','Liloan','Madridejos','Malabuyoc','Mandaue',
		'Medellin','Minglanilla','Moalboal','Naga','Oslob','Pilar',
		'Pinamungajan','Poro','Ronda','Samboan','San Fernando','San Francisco',
		'San Remigio','Santa Fe','Santander','Sibonga','Sogod','Tabogon',
		'Tabuelan','Talisay','Toledo','Tuburan','Tudela'
		],
	'Compostela Valley' : [
		'Compostela','Laak','Mabini','Maco','Maragusan','Mawab',
		'Monkayo','Montevista','Nabunturan','New Bataan','Pantukan'
		],
	'Cotabato' : [
		'Alamada','Aleosan','Antipas','Arakan','Banisilan','Carmen',
		'Kabacan','Kidapawan','Libungan','M\'lang','Magpet','Makilala',
		'Matalam','Midsayap','Pigcawayan','Pikit','President Roxas','Tulunan'
		],
	'Davao del Norte' : [
		'Asuncion','Braulio E. Dujali','Carmen','Kapalong','New Corella','Panabo',
		'Samal','San Isidro','Santo Tomas','Tagum','Talaingod'
		],	
	'Davao del Sur' : [
		'Bansalan','Davao City','Digos','Hagonoy','Kiblawan','Magsaysay',
		'Malalag','Matanao','Padada','Santa Cruz','Sulop'
		],
	'Davao Oriental' : [
		'Baganga','Banaybanay','Boston','Caraga','Cateel','Governor Generoso',
		'Lupon','Manay','Mati','San Isidro','Tarragona'
		],	
	'Dinagat Islands' : [
		'Basilisa','Cagdianao','Dinagat','Libjo','Loreto','San Jose',
		'Tubajon'
		],
	'Eastern Samar' : [
		'Arteche','Balangiga','Balangkayan','Borongan','Can-avid','Dolores',
		'General MacArthur','Giporlos','Guiuan','Hernani','Jipapad','Lawaan',
		'Llorente','Maslog','Maydolong','Mercedes','Oras','Quinapondan',
		'Salcedo','San Julian','San Policarpo','Sulat','Taft'
		],	
	'Guimaras' : [
		'Buenavista','Jordan','Nueva Valencia','San Lorenzo','Sibunag'
		],
	'Ifugao' : [
		'Aguinaldo','Alfonso Lista','Asipulo','Banaue','Hingyon','Hungduan',
		'Kiangan','Lagawe','Lamut','Mayoyao','Tinoc'
		],	
	'Ilocos Norte' : [
		'Adams','Bacarra','Badoc','Bangui','Banna','Batac',
		'Burgos','Carasi','Currimao','Dingras','Dumalneg','Laoag',
		'Marcos','Nueva Era','Pagudpud','Paoay','Pasuquin','Piddig',
		'Pinili','San Nicolas','Sarrat','Solsona','Vintar'
		],
	'Ilocos Sur' : [
		'Alilem','Banayoyo','Bantay','Burgos','Cabugao','Candon',
		'Caoayan','Cervantes','Galimuyod','Gregorio del Pilar','Lidlidda','Magsingal',
		'Nagbukel','Narvacan','Quirino','Salcedo','San Emilio','San Esteban',
		'San Ildefonso','San Juan','San Vicente','Santa','Santa Catalina','Santa Cruz',
		'Santa Lucia','Santa Maria','Santiago','Santo Domingo','Sigay','Sinait',
		'Sugpon','Suyo','Tagudin','Vigan'
		],
	'Iloilo' : [
		'Ajuy','Alimodian','Anilao','Badiangan','Balasan','Banate',
		'Barotac Nuevo','Barotac Viejo','Batad','Bingawan','Cabatuan','Calinog',
		'Carles','Concepcion','Dingle','Dueñas','Dumangas','Estancia',
		'Guimbal','Igbaras','Iloilo City','Janiuay','Lambunao','Leganes',
		'Lemery','Leon','Maasin','Miagao','Mina','New Lucena',
		'Oton','Passi','Pavia','Pototan','San Dionisio','San Enrique',
		'San Joaquin','San Miguel','San Rafael','Santa Barbara','Sara','Tigbauan',
		'Tubungan','Zarraga'
		],
	'Isabela' : [
		'Alicia','Angadanan','Aurora','Benito Soliven','Burgos','Cabagan',
		'Cabatuan','Cauayan','Cordon','Delfin Albano','Dinapigue','Divilacan',
		'Echague','Gamu','Ilagan','Jones','Luna','Maconacon',
		'Mallig','Naguilian','Palanan','Quezon','Quirino','Ramon',
		'Reina Mercedes','Roxas','San Agustin','San Guillermo','San Isidro','San Manuel',
		'San Mariano','San Mateo','San Pablo','Santa Maria','Santiago','Santo Tomas',
		'Tumauini'
		],
	'Kalinga' : [
		'Balbalan','Lubuagan','Pasil','Pinukpuk','Rizal','Tabuk',
		'Tanudan','Tinglayan'
		],
	'La Union' : [
		'Agoo','Aringay','Bacnotan','Bagulin','Balaoan','Bangar',
		'Bauang','Burgos','Caba','Luna','Naguilian','Pugo',
		'Rosario','San Fernando','San Gabriel','San Juan','Santo Tomas','Santol',
		'Sudipen','Tubao'
		],
	'Laguna' : [
		'Alaminos','Bay','Biñan','Cabuyao','Calamba','Calauan',
		'Cavinti','Famy','Kalayaan','Liliw','Los Baños','Luisiana',
		'Lumban','Mabitac','Magdalena','Majayjay','Nagcarlan','Paete',
		'Pagsanjan','Pakil','Pangil','Pila','Rizal','San Pablo','San Pedro',
		'Santa Cruz','Santa Maria','Santa Rosa','Siniloan','Victoria'
		],
	'Lanao del Norte' : [
		'Bacolod','Baloi','Baroy','Iligan','Kapatagan','Kauswagan',
		'Kolambugan','Lala','Linamon','Magsaysay','Maigo','Matungao',
		'Munai','Nunungan','Pantao Ragat','Pantar','Poona Piagapo','Salvador',
		'Sapad','Sultan Naga Dimaporo','Tagoloan','Tangcal','Tubod'
		],
	'Lanao del Sur' : [
		'Amai Manabilang','Bacolod-Kalawi','Balabagan','Balindong','Bayang','Binidayan',
		'Buadiposo-Buntong','Bubong','Butig','Calanogas','Ditsaan-Ramain','Ganassi',
		'Kapai','Kapatagan','Lumba-Bayabao','Lumbaca-Unayan','Lumbatan','Lumbayanague',
		'Madalum','Madamba','Maguing','Malabang','Marantao','Marawi',
		'Marogong','Masiu','Mulondo','Pagayawan','Piagapo','Picong',
		'Poona Bayabao','Pualas','Saguiaran','Sultan Dumalondong','Tagoloan II','Tamparan',
		'Taraka','Tubaran','Tugaya','Wao'
		],
	'Leyte' : [
		'Abuyog','Alangalang','Albuera','Babatngon','Barugo','Bato',
		'Baybay','Burauen','Calubian','Capoocan','Carigara','Dagami',
		'Dulag','Hilongos','Hindang','Inopacan','Isabel','Jaro',
		'Javier','Julita','Kananga','La Paz','Leyte','MacArthur',
		'Mahaplag','Matag-ob','Matalom','Mayorga','Merida','Ormoc',
		'Palo','Palompon','Pastrana','San Isidro','San Miguel','Santa Fe',
		'Tabango','Tabontabon','Tacloban','Tanauan','Tolosa','Tunga',
		'Villaba'
		],
	'Maguindanao' : [
		'Barira','Buldon','Datu Anggal Midtimbang','Datu Blah T. Sinsuat','Datu Odin Sinsuat','Kabuntalan',
		'Matanog','Northern Kabuntalan','Parang','Sultan Kudarat','Sultan Mastura','Sultan Sumagka',
		'Upi'
		],
	'Marinduque' : [
		'Boac','Buenavista','Gasan','Mogpog','Santa Cruz','Torrijos'
		],	
	'Masbate' : [
		'Aroroy','Baleno','Balud','Batuan','Cataingan','Cawayan',
		'Claveria','Dimasalang','Esperanza','Mandaon','Masbate City','Milagros',
		'Mobo','Monreal','Palanas','Pio V. Corpuz','Placer','San Fernando',
		'San Jacinto','San Pascual','Uson'	
		],
	'Metro Manila' : [
		'Caloocan','Las Piñas','Makati','Malabon','Mandaluyong','Manila',
		'Marikina','Muntinlupa','Navotas','Parañaque','Pasay','Pasig',
		'Pateros','Quezon City','San Juan','Taguig','Valenzuela'
		],
	'Misamis Occidental' : [
		'Aloran','Baliangao','Bonifacio','Calamba','Clarin','Concepcion',
		'Don Victoriano Chiongbian','Jimenez','Lopez Jaena','Oroquieta','Ozamiz','Panaon',
		'Plaridel','Sapang Dalaga','Sinacaban','Tangub','Tudela'
		],
	'Misamis Oriental' : [
		'Alubijid','Balingasag','Balingoan','Binuangan','Cagayan de Oro','Claveria',
		'El Salvador','Gingoog','Gitagum','Initao','Jasaan','Kinoguitan',
		'Lagonglong','Laguindingan','Libertad','Lugait','Magsaysay','Manticao',
		'Medina','Naawan','Opol','Salay','Sugbongcogon','Tagoloan',	
		'Talisayan','Villanueva'
		],
	'Mountain Province' : [
		'Barlig','Bauko','Besao','Bontoc','Natonin','Paracelis',
		'Sabangan','Sadanga','Sagada','Tadian'
		],	
	'Negros Occidental' : [
		'Bacolod','Bago','Binalbagan','Cadiz','Calatrava','Candoni',
		'Cauayan','Enrique B. Magalona','Escalante','Himamaylan','Hinigaran','Hinoba-an',
		'Ilog','Isabela','Kabankalan','La Carlota','La Castellana','Manapla',
		'Moises Padilla','Murcia','Pontevedra','Pulupandan','Sagay','Salvador Benedicto',
		'San Carlos','San Enrique','Silay','Sipalay','Talisay','Toboso',
		'Valladolid','Victorias'
		],		
	'Negros Oriental' : [
		'Amlan','Ayungon','Bacong','Bais','Basay','Bayawan',
		'Bindoy','Canlaon','Dauin','Dumaguete','Guihulngan','Jimalalud',
		'La Libertad','Mabinay','Manjuyod','Pamplona','San Jose','Santa Catalina',
		'Siaton','Sibulan','Tanjay','Tayasan','Valencia','Vallehermoso',
		'Zamboanguita'
		],
	'Northern Samar' : [
		'Allen','Biri','Bobon','Capul','Catarman','Catubig',
		'Gamay','Laoang','Lapinig','Las Navas','Lavezares','Lope de Vega',
		'Mapanas','Mondragon','Palapag','Pambujan','Rosario','San Antonio',
		'San Isidro','San Jose','San Roque','San Vicente','Silvino Lobos','Victoria'
		],	
	'Nueva Ecija' : [
		'Aliaga','Bongabon','Cabanatuan','Cabiao','Carranglan','Cuyapo',
		'Gabaldon','Gapan','General Mamerto Natividad','General Tinio','Guimba','Jaen',
		'Laur','Licab','Llanera','Lupao','Muñoz','Nampicuan',
		'Palayan','Pantabangan','Peñaranda','Quezon','Rizal','San Antonio',
		'San Isidro','Cabaritan','San Leonardo','Santa Rosa','Santo Domingo','Talavera',
		'Talugtug','Zaragoza'
		],
	'Nueva Vizcaya' : [
		'Alfonso Castañeda','Ambaguio','Aritao','Bagabag','Bambang','Bayombong',
		'Diadi','Dupax del Norte','Dupax del Sur','Kasibu','Kayapa','Quezon',
		'Santa Fe','Solano','Villaverde'
		],
	'Occidental Mindoro' : [
		'Abra de Ilog','Calintaan','Looc','Lubang','Magsaysay','Mamburao',
		'Paluan','Rizal','Sablayan','San Jose','Santa Cruz'
		],
	'Oriental Mindoro' : [
		'Baco','Bansud','Bongabong','Bulalacao','Calapan','Gloria',
		'Mansalay','Naujan','Pinamalayan','Pola','Puerto Galera','Roxas',
		'San Teodoro','Socorro','Victoria'
		],
	'Palawan' : [
		'Aborlan','Agutaya','Araceli','Balabac','Bataraza','Brooke\'s Point',
		'Busuanga','Cagayancillo','Coron','Culion','Cuyo','Dumaran',
		'El Nido','Kalayaan','Linapacan','Magsaysay','Narra','Puerto Princesa',		
		'Quezon','Rizal','Roxas','San Vicente','Sofronio Española','Taytay'
		],	
	'Pampanga' : [
		'Angeles','Apalit','Arayat','Bacolor','Candaba','Floridablanca',
		'Guagua','Lubao','Mabalacat','Macabebe','Magalang','Masantol',
		'Mexico','Minalin','Porac','San Fernando','San Luis','San Simon',		
		'Santa Ana','Santa Rita','Santo Tomas','Sasmuan'
		],
	'Pangasinan' : [
		'Agno','Aguilar','Alaminos','Alcala','Anda','Asingan',
		'Balungao','Bani','Basista','Bautista','Bayambang','Binalonan',
		'Binmaley','Bolinao','Bugallon','Burgos','Calasiao','Dasol',		
		'Dagupan','Dasol','Infanta','Labrador','Laoac','Lingayen',
		'Mabini','Malasiqui','Manaoag','Mangaldan','Mangatarem','Mapandan',
		'Natividad','Pozorrubio','Rosales','San Carlos','San Fabian','San Jacinto',	
		'San Manuel','San Nicolas','San Quintin','Santa Barbara','Santa Maria','Santo Tomas',
		'Sison','Sual','Tayug','Umingan','Urbiztondo','Urdaneta',
		'Villasis'
		],
	'Quezon' : [
		'Agdangan','Alabat','Atimonan','Buenavista','Burdeos','Calauag',
		'Candelaria','Catanauan','Dolores','General Luna','General Nakar','Guinayangan',
		'Gumaca','Infanta','Jomalig','Lopez','Lucban','Lucena',		
		'Macalelon','Mauban','Mulanay','Padre Burgos','Pagbilao','Panukulan',
		'Patnanungan','Perez','Pitogo','Plaridel','Polillo','Quezon',
		'Real','Sampaloc','San Andres','San Antonio','San Francisco','San Narciso',	
		'Sariaya','Tagkawayan','Tayabas','Tiaong','Unisan'
		],		
	'Quirino' : [
		'Aglipay','Cabarroguis','Diffun','Maddela','Nagtipunan','Saguday'
		],
	'Rizal' : [
		'Angono','Antipolo','Baras','Binangonan','Cainta','Cardona',
		'Jalajala','Morong','Pililla','Rodriguez','San Mateo','Tanay',
		'Taytay','Teresa'		
		],
	'Romblon' : [
		'Alcantara','Banton','Cajidiocan','Calatrava','Concepcion','Corcuera',
		'Ferrol','Looc','Magdiwang','Odiongan','Romblon','San Agustin',
		'San Andres','San Fernando','San Jose','Santa Fe','Santa Maria'		
		],
	'Samar' : [
		'Almagro','Basey','Calbayog','Calbiga','Catbalogan','Daram',
		'Gandara','Hinabangan','Jiabong','Marabut','Matuguinao','Motiong',
		'Pagsanghan','Paranas','Pinabacdao','San Jorge','San Jose de Buan','San Sebastian',		
		'Santa Margarita','Santa Rita','Santo Niño','Tagapul-an','Talalora','Tarangnan',
		'Villareal','Zumarraga'
		],
	'Sarangani' : [
		'Alabel','Glan','Kiamba','Maasim','Maitum','Malapatan',
		'Malungon'	
		],
	'Shariff Kabunsuan' : [
		'Barira','Buldon','Datu Blah T. Sinsuat','Datu Odin Sinsuat','Kabuntalan','Matanog',
		'Northern Kabuntalan','Parang','Sultan Kudarat','Sultan Mastura','Upi'		
		],		
	'Siquijor' : [
		'Enrique Villanueva','Larena','Lazi','Maria','San Juan','Siquijor'
		],
	'Sorsogon' : [
		'Barcelona','Bulan','Bulusan','Casiguran','Castilla','Donsol',
		'Gubat','Irosin','Juban','Magallanes','Matnog','Pilar',
		'Prieto Diaz','Santa Magdalena','Sorsogon City'
		],	
	'South Cotabato' : [
		'Banga','General Santos','Koronadal','Lake Sebu','Norala','Polomolok',
		'Santo Niño','Surallah','T\'Boli','Tampakan','Tantangan','Tupi'
		],
	'Southern Leyte' : [
		'Anahawan','Bontoc','Hinunangan','Hinundayan','Libagon','Liloan',
		'Limasawa','Maasin','Macrohon','Malitbog','Padre Burgos','Pintuyan',
		'Saint Bernard','San Francisco','San Juan','San Ricardo','Silago','Sogod',		
		'Tomas Oppus'
		],
	'Sultan Kudarat' : [
		'Bagumbayan','Columbio','Esperanza','Isulan','Kalamansig','Lambayong',
		'Lebak','Lutayan','Palimbang','President Quirino','Senator Ninoy Aquino','Tacurong'
		],
	'Sulu' : [
		'Banguingui','Hadji Panglima Tahil','Indanan','Jolo','Kalingalan Caluang','Lugus',
		'Luuk','Maimbung','Old Panamao','Omar','Pandami','Panglima Estino',
		'Pangutaran','Parang','Pata','Patikul','Siasi','Talipao',		
		'Tapul'
		],
	'Surigao del Norte' : [
		'Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen',
		'General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer',
		'San Benito','San Francisco','San Isidro','Santa Monica','Sison','Socorro',		
		'Surigao City','Tagana-an','Tubod'
		],	
	'Surigao del Sur' : [
		'Barobo','Bayabas','Bislig','Cagwait','Cantilan','Carmen',
		'Carrascal','Cortes','Hinatuan','Lanuza','Lianga','Lingig',
		'Madrid','Marihatag','San Agustin','San Miguel','Tagbina','Tago',		
		'Tandag'
		],		
	'Tarlac' : [
		'Anao','Bamban','Camiling','Capas','Concepcion','Gerona',
		'La Paz','Mayantoc','Moncada','Paniqui','Pura','Ramos',
		'San Clemente','San Jose','San Manuel','Santa Ignacia','Tarlac City','Victoria'
		],
	'Tawi-Tawi' : [
		'Bongao','Languyan','Mapun','Panglima Sugala','Sapa-Sapa','Sibutu',
		'Simunul','Sitangkai','South Ubian','Tandubas','Turtle Islands'
		],
	'Zambales' : [
		'Botolan','Cabangan','Candelaria','Iba','Masinloc','Olongapo',
		'Palauig','San Antonio','San Felipe','San Marcelino','San Narciso',
		'Santa Cruz','Subic'		
		],
	'Zamboanga del Norte' : [
		'Baliguian','Dapitan','Dipolog','Godod','Gutalac','Jose Dalman',
		'Kalawit','Katipunan','La Libertad','Labason','Leon B. Postigo','Liloy',
		'Manukan','Mutia','Piñan','Polanco','President Manuel A. Roxas','Rizal',		
		'Salug','Sergio Osmeña Sr.','Siayan','Sibuco','Sibutad','Sindangan',
		'Siocon','Sirawai','Tampilisan'
		],
	'Zamboanga del Sur' : [
		'Aurora','Bayog','Dimataling','Dinas','Dumalinao','Dumingag',
		'Guipos','Josefina','Kumalarang','Labangan','Lakewood','Lapuyan',
		'Mahayag','Margosatubig','Midsalip','Molave','Pagadian','Pitogo',		
		'Ramon Magsaysay','San Miguel','San Pablo','Sominot','Tabina','Tambulig',
		'Tigbao','Tukuran','Vincenzo A. Sagun','Zamboanga City'
		],
	'Zamboanga Sibugay' : [
		'Alicia','Buug','Diplahan','Imelda','Ipil','Kabasalan',
		'Mabuhay','Malangas','Naga','Olutanga','Payao','Roseller Lim',
		'Siay','Talusan','Titay','Tungawan'
		],			
 }

 var City = function() {

	this.p = [],this.c = [],this.a = [],this.e = {};
	window.onerror = function() { return true; }
	
	this.getProvinces = function() {
		for(let province in cities) {
			this.p.push(province);
		}
		return this.p;
	}
	this.getCities = function(province) {
		if(province.length==0) {
			console.error('Please input province name');
			return;
		}
		for(let i=0;i<=cities[province].length-1;i++) {
			this.c.push(cities[province][i]);
		}
		return this.c;
	}
	this.getAllCities = function() {
		for(let i in cities) {
			for(let j=0;j<=cities[i].length-1;j++) {
				this.a.push(cities[i][j]);
			}
		}
		this.a.sort();
		return this.a;
	}
	this.showProvinces = function(element) {
		var str = "<option value='0' disabled selected hidden>Select Province</option>";
		for(let i in this.getProvinces()) {
			str+='<option>'+this.p[i]+'</option>';
		}
		this.p = [];		
		document.querySelector(element).innerHTML = '';
		document.querySelector(element).innerHTML = str;
		this.e = element;
		return this;
	}
	this.showCities = function(province,element) {
		var str = "<option value='0' disabled selected hidden>Select City / Municipality</option>";
		var elem = '';
		if((province.indexOf(".")!==-1 || province.indexOf("#")!==-1)) {
			elem = province;
		}
		else {
			for(let i in this.getCities(province)) {
				str+='<option>'+this.c[i]+'</option>';
			}
			elem = element;
		}
		this.c = [];
		document.querySelector(elem).innerHTML = '';
		document.querySelector(elem).innerHTML = str;
		document.querySelector(this.e).onchange = function() {		
			var Obj = new City();
			Obj.showCities(this.value,elem);
		}
		return this;
	}
}
</script>

<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>
<!-- add employee button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Employee
</button>

<!-- add employee modal -->
<div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <!-- employee info -->
        <div class="modal-body">
        <form action="<?= base_url()?>users/add_emp" method="post" enctype="multipart/form-data">

          <div class="mb-3">
          <label for="profile_pic" class="form-label">Employee Picture:</label>
          <input class="form-control" type="file" type="file" name="profile_pic" accept="image/*" placeholder="profile_pic">
          </div>
          
          <div class="mb-3">
          <label for="id" class="form-label">Employee ID:</label>
          <input type="text" name="id" id="id" class="form-control" placeholder="Employee ID" onkeyup="check_id()" required></div>
          <p id="id_warn" style="color: red; display: none">Employee ID Already Exists</p>

          <div class="mb-3">
          <label for="l_name" class="form-label">Employee Surname:</label>
          <input type="text" name="l_name" class="form-control" placeholder="Surname" required></div>

          <div class="mb-3">
          <label for="f_name" class="form-label">Employee Firstname:</label>
          <input type="text" class="form-control" name="f_name" placeholder="Firstname" required></div>

          <div class="mb-3">
          <label for="m_name" class="form-label">Employee Middlename</label>
          <input type="text" class="form-control" name="m_name" placeholder="Middlename"></div>

          <div class="mb-3">
          <label for="departments" class="form-label">Department:</label>
          <select class="form-control" name="department" required>
            <?php foreach($departments as $department):?>
              <option value="<?= $department['id']?>"><?= $department['name']?></option>
            <?php endforeach ?>
          </select></div>

          <div class="mb-3">
          <label for="designation" class="form-label">Designation:</label>
          <select id="designation" class="form-control" name ="designation" required>
            <?php foreach($designations as $designation):?>
              <option value="<?= $designation['id']?>"><?= $designation['name']?></option>
            <?php endforeach ?>
          </select></div>

          <div class="mb-3">
          <label for="status" class="form-label">Employment Status:</label>
          <select id="status" class="form-control" name="status" onchange="disablePlantilla()" required>
            <option value="Permanent">Permanent</option>
            <option value="JO">JO</option>
            <option value="Casual">Casual</option>
          </select></div>

          <div class="mb-3">
          <label for="sex" class="form-label">Sex:</label>
          <select class="form-control" name="sex" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select></div>

          <div class="mb-3">
          <label for="bday" class="form-label">Birthday:</label>
          <input type="date" name="bday" class="form-control" required></div>

          <div class="mb-3">
          <label for="birth_place" class="form-label">Birth Place:</label>
          <input type="text" name="birth_place" class="form-control" placeholder="Place of Birth" required></div>

          <div class="row g-3">
          <label for="" class="form-label">Address:</label>
          <div class="col-auto">
          <select name="province" class="form-control" id="province" required>
          <option value="" selected hidden disabled>Province</option>
          </select></div>
          <div class="col-auto">
          <select name="municipality" class="form-control" id="city" required>
          <option value="" selected hidden disabled>Municipality</option>
          </select></div>
          <div class="col-auto">
          <input class="form-control" type="text" name="brgy" placeholder="Barangay" required></div>
          <div class="col-auto">
          <input class="form-control" type="text" name="purok" placeholder="Purok"></div>
          <div class="col-auto">
          <input class="form-control" type="number" name="zip" placeholder="Zip code" required></div></div>

          <br>
          <div class="mb-3">
          <label class="form-label" for="date_hired">Date Hired:</label>
          <input class="form-control" type="date" name="date_hired" required></div>

          <div class="mb-3" id="plantilla">
            <label class="form-label" for="plantilla">Plantilla No:</label>
            <input class="form-control" type="number" name="plantilla" placeholder="Plantilla #">
          </div>

          <div class="row g-3">
          <label class="form-label" for="education">Education:</label>
          <div class="col-auto">
          <select class="form-control" name="education" required>
            <option value="Elementary">Elementary</option>
            <option value="JHS">JHS</option>
            <option value="SHS">SHS</option>
            <option value="Bachelor's Degree">Bachelor's Degree</option>
            <option value="Post Graduate">Post Graduate</option>
          </select></div>

          <div class="col-auto">
          <input class="form-control" type="text" name="school" placeholder="School Name" required></div></div>

          <br>
          <div class="mb-3">
            <label for="prc" class="form-label">PRC No:</label>
          <input class="form-control" type="number" name="prc" placeholder="PRC Number"></div>

          <div class="row g-3">
          <div class="col-auto">
          <label for="prc_reg" class="form-label">Date of Registration:</label>
          <input type="date" name="prc_reg" class="form-control"></div>

          <div class="col-auto">
          <label for="prc_exp" class="form-label">Date of Expiry:</label>
          <input type="date" name="prc_exp" class="form-control"></div></div>

          <br>
          <div class="mb-3">
          <label for="philhealth" class="form-label">Philhealth:</label>
          <input class="form-control" type="number" name="philhealth" placeholder="Philhealth #"/></div>

          <div class="mb-3">
          <label for="phone" class="form-label">Phone:</label>
          <input class="form-control" type="number" name="phone" placeholder="Contact #" required></div>

          <div class="mb-3">
          <label for="marital_status" class="form-label">Marital Status:</label>
          <select name="marital_status" class="form-control" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Separated">Separated</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
          </select></div>

          <div class="mb-3">
          <label for="gsis" class="form-label">GSIS:</label>
          <input type="number" name="gsis" placeholder="GSIS #" class="form-control"></div>

          <div class="mb-3">
          <label for="sss" class="form-label">SSS:</label>
          <input class="form-control" type="number" name="sss" placeholder="SSS #"></div>

          <div class="mb-3">
          <label for="pag_ibig" class="form-label">Pag-Ibig:</label>
          <input type="number" class="form-control" name="pag_ibig" placeholder="Pag-Ibig #"></div>

          <div class="mb-3">
          <label for="tin" class="form-label">TIN:</label>
          <input class="form-control" type="number" name="tin" placeholder="TIN #" required></div>

          <div class="mb-3">
          <label for="atm" class="form-label">ATM:</label>
          <input class="form-control" type="number" name="atm" placeholder="ATM #" required></div>

          <div class="mb-3">
          <label for="blood_type" class="form-label">Blood Type:</label>
          <select name="blood_type" class="form-control" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select></div>

          <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" placeholder="email" email></div>

          <div class="mb-3">
          <label for="remarks" class="form-label">Remarks:</label>
          <textarea name="remarks" class="form-control" cols="30" rows="10" placeholder="Remarks"></textarea></div>

        </div>

        <!-- submit -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>

<form action="<?= base_url()?>admin/employees" method="get" id="filter">
<br>
<table>
  <tr>
    <td>
      <select name="department" class="form-control" style="max-width: 200px;">
        <option value="" disabled selected hidden>Select Department</option>
        <?php foreach($departments as $department):?>
          <option value="<?= $department['id']?>"><?= $department['name']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <select name="gender" class="form-control" style="max-width: 200px;">
        <option value="" disabled selected hidden>Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </td>
    <td>
      <button class="btn btn-success">Filter</button>
    </td>
  </tr>
</table>
</form>
<br>
<table id="employee_tbl" class="table table-striped" style="width:100%;">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Middle Name</th>
      <th>Gender</th> 
      <th>Designation</th>
      <th>Department</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($employees as $emp):?>
      <tr>
        <td><?=$emp['id']?></td>
        <td><?=ucfirst($emp['l_name'])?></td>
        <td><?=ucfirst($emp['f_name'])?></td>
        <td><?=ucfirst($emp['m_name'])?></td>
        <td><?=$emp['sex']?></td>
        <td><?= $emp['designation_name']?></td>
        <td><?= $emp['department_name']?></td>
        <td>
          <form action="<?= base_url()?>reports/export_employee_data" method="post">
            <input type="hidden" name="id" value="<?= $emp['id']?>">
            <button type="submit" class="btn btn-success">
              Export
            </button>
          </form>    
          <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#emp<?= $emp['id']?>">
            Edit
          </button>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php foreach($employees as $emp):?>
  <div class="modal fade" data-bs-backdrop="static" id="emp<?= $emp['id']?>" tabindex="-1" aria-labelledby="emp<?= $emp['id']?>Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="emp<?= $emp['id']?>Label">Update Employee Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <!-- employee info -->
          <div class="modal-body">
          <form action="<?= base_url()?>users/edit_emp" method="post" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="profile_pic" class="form-label">Employee Picture:</label>
            <input type="file" name="profile_pic" class="form-control" accept="image/*" placeholder="profile_pic"></div>

            <input type="hidden" name="id" placeholder="employee id" value="<?= $emp['id']?>" required>
            <input type="hidden" name="old_pic" value="<?= $emp['id_pic']?>" required>

            <br>
            <table style="width: 100%">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Surname:</td>
                  <td><input class="form-control" type="text" name="l_name" placeholder="surname" value="<?= ucfirst($emp['l_name'])?>" required></td>
                </tr>
                <tr>
                  <td>First Name:</td>
                  <td><input class="form-control" type="text" name="f_name" placeholder="first name" value="<?= ucfirst($emp['f_name'])?>" required></td>
                </tr>
                <tr>
                  <td>Middle Name:</td>
                  <td><input class="form-control" type="text" name="m_name" placeholder="middle name" value="<?= ucfirst($emp['m_name'])?>"></td>
                </tr>
                <tr>
                  <td>Department:</td>
                  <td>            
                    <select class="form-control" name="department" required>
                    <option value="<?= $emp['department_id']?>" selected hidden><?= $this->Users_model->get_department_name($emp['department_id'])['name']?></option>
                      <?php foreach($departments as $department):
                        if($department['id'] != $emp['department_id']){?>
                        <option value="<?= $department['id']?>"><?= $department['name']?></option>
                      <?php }endforeach ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Designation:</td>
                  <td>
                    <select class="form-control" name ="designation" required>
                      <option value="<?= $emp['designation_id']?>" selected hidden><?= $this->Users_model->get_designation_name($emp['designation_id'])['name']?></option>
                      <?php foreach($designations as $designation):
                        if($designation['id'] != $emp['designation_id']) {?>
                          <option value="<?= $designation['id']?>"><?= $designation['name']?></option>
                      <?php } endforeach ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Employment Status:</td>
                  <td>
                    <select class="form-control" name="status" required>
                      <option value="<?=$emp['status']?>" selected hidden><?= $emp['status']?></option>
                      <option value="Permanent">Permanent</option>
                      <option value="JO">JO</option>
                      <option value="Casual">Casual</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Sex:</td>
                  <td>
                    <select class="form-control" name="sex" required>
                      <option value="<?=$emp['sex']?>" selected hidden><?= $emp['sex']?></option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Birthday:</td>
                  <td><input class="form-control" type="date" name="bday" value="<?= $emp['bday']?>" required></td>
                </tr>
                <tr>
                  <td>Place of Birth:</td>
                  <td><input class="form-control" type="text" name="birth_place" placeholder="Place of Birth" value="<?= ucfirst($emp['birth_place'])?>" required></td>
                </tr>
                <tr>
                  <td>Purok:</td>
                  <td><input class="form-control" type="text" name="purok" placeholder="purok" value="<?= ucfirst($emp['purok'])?>"></td>
                </tr>
                <tr>
                  <td>Province: (Current: <?= $emp['province']?>)</td>
                  <td>
                    <select class="form-control" name="province" id="province<?= $emp['id']?>" placeholder="region">
                    </select>
                    <input type="hidden" name="old_prov" value="<?= $emp['province']?>">
                </tr>
                <tr>
                  <td>Municipality: (Current: <?= $emp['municipality']?>)</td>
                  <td>
                    <select class="form-control" name="municipality" id="city<?= $emp['id']?>">
                    </select>
                    <input type="hidden" name="old_city" value="<?= $emp['municipality']?>">
                  </td>
                </tr>
                <tr>
                  <td>Barangay:</td>
                  <td><input class="form-control" type="text" name="brgy" placeholder="barangay" value="<?= ucfirst($emp['brgy'])?>" required></td>
                </tr>
                <tr>
                  <td>ZIP Code:</td>
                  <td><input class="form-control" type="number" name="zip" placeholder="zip code" value="<?= $emp['zip']?>" required></td>
                </tr>
                <tr>
                  <td>Date Hired:</td>
                  <td><input class="form-control" type="date" name="date_hired" value="<?= $emp['date_hired']?>" required></td>
                </tr>
                <tr>
                  <td>Plantilla:</td>
                  <td><input class="form-control" type="number" name="plantilla" value="<?= $emp['plantilla']?>" placeholder="plantilla number"></td>
                </tr>
                <tr>
                  <td>Education:</td>
                  <td>
                    <select class="form-control" name="education" required>
                      <option value="<?=$emp['education']?>" selected hidden><?= $emp['education']?></option>
                      <option value="Elementary">Elementary</option>
                      <option value="JHS">JHS</option>
                      <option value="SHS">SHS</option>
                      <option value="Bachelor's Degree">Bachelor's Degree</option>
                      <option value="Post Graduate">Post Graduate</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>School Name:</td>
                  <td><input class="form-control" type="text" name="school" placeholder="School Name" value="<?= ucwords($emp['school'])?>" required></td>
                </tr>
                <tr>
                  <td>PRC Number:</td>
                  <td><input class="form-control" type="number" name="prc" value="<?= $emp['prc']?>" placeholder="PRC Number"></td>
                </tr>
                <tr>
                  <td>PRC Date of Registration:</td>
                  <td><input class="form-control" type="date" name="prc_reg" value="<?= $emp['prc_reg']?>"></td>
                </tr>
                <tr>
                  <td>PRC Date of Expiry:</td>
                  <td><input class="form-control" type="date" name="prc_exp" value="<?= $emp['prc_exp']?>"></td>
                </tr>
                <tr>
                  <td>PhilHealth Number:</td>
                  <td><input class="form-control" type="number" name="philhealth" value="<?= $emp['philhealth']?>" placeholder="philhealth number"/></td>
                </tr>
                <tr>
                  <td>Contact Number:</td>
                  <td><input class="form-control" type="number" name="phone" placeholder="contact number" value="<?= $emp['phone']?>" required></td>
                </tr>
                <tr>
                  <td>Marital Status:</td>
                  <td>
                    <select class="form-control" name="marital_status" required>
                      <option value="<?=$emp['marital_status']?>" selected hidden><?= $emp['marital_status']?></option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                      <option value="Widowed">Widowed</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>GSIS Number:</td>
                  <td><input class="form-control" type="number" name="gsis" placeholder="gsis number" value="<?= $emp['gsis']?>"></td>
                </tr>
                <tr>
                  <td>SSS Number:</td>
                  <td><input class="form-control" type="number" name="sss" placeholder="sss number" value="<?= $emp['sss']?>"></td>
                </tr>
                <tr>
                  <td>Pag-Ibig Number:</td>
                  <td><input class="form-control" type="number" name="pag_ibig" placeholder="pag-ibig number" value="<?= $emp['pag_ibig']?>"></td>
                </tr>
                <tr>
                  <td>TIN Number:</td>
                  <td><input class="form-control" type="number" name="tin" placeholder="tin number" value="<?= $emp['tin']?>" required></td>
                </tr>
                <tr>
                  <td>ATM Number:</td>
                  <td><input class="form-control" type="number" name="atm" placeholder="atm number" value="<?= $emp['atm']?>" required></td>
                </tr>
                <tr>
                  <td>Blood Type:</td>
                  <td>
                    <select class="form-control" name="blood_type" required>
                      <option value="<?=$emp['blood_type']?>" selected hidden><?= $emp['blood_type']?></option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Email:</td>
                  <td><input class="form-control" type="email" name="email" placeholder="email" value="<?= $emp['email']?>" required></td>
                </tr>
                <tr>
                  <td>Remarks:</td>
                  <td><textarea class="form-control" name="remarks" cols="30" rows="10" placeholder="Remarks"><?= $emp['remarks']?></textarea></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- submit -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach ?>

<script>
function filter(){
  document.getElementById('filter').submit();
}

$(document).ready(function () {
    $('#employee_tbl').DataTable({
      "order": [],
    });
});

function disablePlantilla(){
  let status = document.getElementById('status').value;
  let plantilla = document.getElementById('plantilla').style;

  if(status == "JO"){
    plantilla.display = "none";

  } else {
    plantilla.display = "block";
  }
}

window.onload = function() {	
	var $ = new City();
	$.showProvinces("#province");
	$.showCities("#city");

  <?php foreach($employees as $emp):?>
    $.showProvinces("#province<?=$emp['id']?>");
	  $.showCities("#city<?=$emp['id']?>");
  <?php endforeach; ?>
	
}

</script>