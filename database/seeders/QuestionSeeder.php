<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            'Croatia' => [
                ['What is the capital of Croatia?', ['Zagreb', 'Split', 'Rijeka', 'Osijek'], 'a', 'Geography'],
                ['Which sea borders Croatia?', ['Adriatic Sea', 'Baltic Sea', 'Black Sea', 'North Sea'], 'a', 'Geography'],
                ['Which Croatian city is known as the Pearl of the Adriatic?', ['Dubrovnik', 'Pula', 'Zadar', 'Varaždin'], 'a', 'Cities'],
                ['What is Croatia\'s currency?', ['Euro', 'Kuna', 'Forint', 'Dinar'], 'a', 'History'],
                ['Which national park contains the Plitvice Lakes?', ['Plitvice Lakes National Park', 'Krka National Park', 'Brijuni National Park', 'Risnjak National Park'], 'a', 'Nature'],
                ['Which Croatian city is famous for Diocletian\'s Palace?', ['Split', 'Zagreb', 'Dubrovnik', 'Karlovac'], 'a', 'History'],
                ['What is the highest mountain in Croatia?', ['Dinara', 'Velebit', 'Biokovo', 'Medvednica'], 'a', 'Geography'],
                ['Which island is one of Croatia\'s largest islands?', ['Cres', 'Hvar', 'Pag', 'Brač'], 'a', 'Geography'],
                ['What language is the official language of Croatia?', ['Croatian', 'Slovenian', 'Serbian', 'Italian'], 'a', 'Culture'],
                ['Which Croatian city hosted the 1979 Mediterranean Games?', ['Split', 'Rijeka', 'Pula', 'Zadar'], 'a', 'History'],
                ['What color is the central shield on Croatia\'s coat of arms?', ['Red and white checks', 'Blue and yellow stripes', 'Green circles', 'Black stars'], 'a', 'Culture'],
                ['Which river flows through Zagreb?', ['Sava', 'Drava', 'Danube', 'Kupa'], 'a', 'Geography'],
                ['What is the traditional Croatian necktie called?', ['Cravat', 'Keffiyeh', 'Sash', 'Beret'], 'a', 'Culture'],
                ['Which Croatian city is located on the Istrian peninsula?', ['Pula', 'Osijek', 'Sisak', 'Zagreb'], 'a', 'Cities'],
                ['Which sea animal is commonly found in the Adriatic Sea?', ['Dolphin', 'Penguin', 'Walrus', 'Polar bear'], 'a', 'Nature'],
                ['What is the name of Croatia\'s national football team nickname?', ['Vatreni', 'Oranje', 'Azzurri', 'Furia Roja'], 'a', 'Sport'],
                ['Which Croatian scientist invented the mechanical pencil precursor?', ['Slavoljub Penkala', 'Nikola Tesla', 'Ruđer Bošković', 'Ivan Meštrović'], 'a', 'People'],
                ['Which city is Croatia\'s main port on the northern Adriatic?', ['Rijeka', 'Zagreb', 'Vukovar', 'Varaždin'], 'a', 'Cities'],
                ['What type of building is the Arena in Pula?', ['Roman amphitheatre', 'Medieval castle', 'Baroque church', 'Modern stadium'], 'a', 'History'],
                ['Which famous Croatian artist created the sculpture The Well of Life?', ['Ivan Meštrović', 'Vlaho Bukovac', 'Miroslav Šutej', 'Oton Iveković'], 'a', 'Art'],
            ],
            'Netherlands' => [
                ['What is the capital of the Netherlands?', ['Amsterdam', 'Rotterdam', 'The Hague', 'Utrecht'], 'a', 'Geography'],
                ['Which color is strongly associated with the Netherlands?', ['Orange', 'Purple', 'Black', 'White'], 'a', 'Culture'],
                ['What is the Netherlands famous for growing?', ['Tulips', 'Cocoa trees', 'Pineapples', 'Olive trees'], 'a', 'Nature'],
                ['Which city is the seat of the Dutch government?', ['The Hague', 'Amsterdam', 'Eindhoven', 'Groningen'], 'a', 'Politics'],
                ['What is the Dutch currency?', ['Euro', 'Guilder', 'Krone', 'Franc'], 'a', 'History'],
                ['Which structure protects much of the Netherlands from water?', ['Dikes', 'Volcanoes', 'Canals only', 'Tunnels'], 'a', 'Geography'],
                ['Which Dutch painter created The Starry Night?', ['Vincent van Gogh', 'Rembrandt', 'Vermeer', 'Mondrian'], 'a', 'Art'],
                ['What is the largest city in the Netherlands by population?', ['Amsterdam', 'Rotterdam', 'Utrecht', 'Eindhoven'], 'a', 'Cities'],
                ['Which Dutch city is famous for its large port?', ['Rotterdam', 'Leiden', 'Delft', 'Haarlem'], 'a', 'Cities'],
                ['What is a traditional Dutch wooden shoe called?', ['Klomp', 'Sabot', 'Moccasin', 'Geta'], 'a', 'Culture'],
                ['Which sea lies to the north and west of the Netherlands?', ['North Sea', 'Adriatic Sea', 'Baltic Sea', 'Mediterranean Sea'], 'a', 'Geography'],
                ['What is the name of the Dutch national football team nickname?', ['Oranje', 'The Reds', 'The Blues', 'The Greens'], 'a', 'Sport'],
                ['Which famous Dutch artist painted The Night Watch?', ['Rembrandt', 'Van Gogh', 'Frans Hals', 'Jan Steen'], 'a', 'Art'],
                ['What is the main language spoken in the Netherlands?', ['Dutch', 'German', 'Danish', 'Flemish only'], 'a', 'Culture'],
                ['Which Dutch province contains the city of Maastricht?', ['Limburg', 'Zeeland', 'Gelderland', 'Friesland'], 'a', 'Geography'],
                ['What is the name of the Dutch parliament building complex?', ['Binnenhof', 'Rijksmuseum', 'Dam Palace', 'Dom Tower'], 'a', 'Politics'],
                ['Which city is known for the Dom Tower?', ['Utrecht', 'Amsterdam', 'Delft', 'Breda'], 'a', 'Cities'],
                ['What is King\'s Day called in Dutch?', ['Koningsdag', 'Bevrijdingsdag', 'Prinsjesdag', 'Sinterklaas'], 'a', 'Culture'],
                ['Which Dutch scientist is associated with the pendulum clock and astronomy?', ['Christiaan Huygens', 'Antonie van Leeuwenhoek', 'Erasmus', 'Hugo Grotius'], 'a', 'Science'],
                ['Which museum in Amsterdam houses many works by Van Gogh?', ['Van Gogh Museum', 'Mauritshuis', 'Anne Frank House', 'NEMO'], 'a', 'Art'],
            ],
            'Sweden' => [
                ['What is the capital of Sweden?', ['Stockholm', 'Gothenburg', 'Malmo', 'Uppsala'], 'a', 'Geography'],
                ['Which sea lies east of Sweden?', ['Baltic Sea', 'North Sea', 'Adriatic Sea', 'Black Sea'], 'a', 'Geography'],
                ['What is the currency of Sweden?', ['Swedish krona', 'Euro', 'Krone', 'Franc'], 'a', 'History'],
                ['What are the traditional Swedish open sandwiches called?', ['Smorgas', 'Tapas', 'Meze', 'Bento'], 'a', 'Culture'],
                ['Which Swedish company is famous for flat-pack furniture?', ['IKEA', 'Volvo', 'Ericsson', 'H&M'], 'a', 'Business'],
                ['Which Swedish city is known for the Liseberg amusement park?', ['Gothenburg', 'Stockholm', 'Kiruna', 'Vasteras'], 'a', 'Cities'],
                ['What is the name of Sweden\'s indigenous people?', ['Sami', 'Inuit', 'Maori', 'Basques'], 'a', 'People'],
                ['Which Swedish scientist established the Celsius temperature scale?', ['Anders Celsius', 'Alfred Nobel', 'Carl Linnaeus', 'Svante Arrhenius'], 'a', 'Science'],
                ['Which Swedish group had hits including Dancing Queen?', ['ABBA', 'Roxette', 'Europe', 'Ace of Base'], 'a', 'Music'],
                ['What is Sweden\'s national animal?', ['Moose', 'Brown bear', 'Reindeer', 'Wolf'], 'a', 'Nature'],
                ['Which Swedish city is the home of the Vasa Museum?', ['Stockholm', 'Malmo', 'Lund', 'Orebro'], 'a', 'Culture'],
                ['What is the name of the Swedish royal palace in Stockholm?', ['Stockholm Palace', 'Drottningholm only', 'Gripsholm', 'Kalmar Castle'], 'a', 'History'],
                ['Which Swedish author created Pippi Longstocking?', ['Astrid Lindgren', 'Selma Lagerlof', 'Tove Jansson', 'Karin Boye'], 'a', 'Literature'],
                ['What is the largest lake in Sweden?', ['Lake Vanern', 'Lake Vattern', 'Lake Malaren', 'Lake Hjalmaren'], 'a', 'Geography'],
                ['Which Swedish car brand is known for safety?', ['Volvo', 'Saab', 'Scania', 'Koenigsegg'], 'a', 'Business'],
                ['What is celebrated in Sweden on Midsummer?', ['The summer solstice', 'The winter solstice', 'The harvest moon', 'The first snowfall'], 'a', 'Culture'],
                ['Which Swedish inventor founded the Nobel Prize?', ['Alfred Nobel', 'Gustav Dalén', 'Nils Bohlin', 'John Ericsson'], 'a', 'People'],
                ['Which Swedish region is famous for the Icehotel?', ['Kiruna', 'Skane', 'Gotland', 'Dalarna'], 'a', 'Tourism'],
                ['What is the official language of Sweden?', ['Swedish', 'Norwegian', 'Danish', 'Finnish'], 'a', 'Culture'],
                ['Which Swedish island is the largest in the Baltic Sea?', ['Gotland', 'Oland', 'Orust', 'Hisingen'], 'a', 'Geography'],
            ],
        ];

        Question::whereIn('country', array_keys($questions))->delete();

        foreach ($questions as $country => $countryQuestions) {
            foreach (['easy', 'medium', 'hard'] as $difficulty) {
                foreach ($countryQuestions as [$text, $options, $correct, $category]) {
                    Question::create([
                        'question_text' => $text,
                        'option_a' => $options[0],
                        'option_b' => $options[1],
                        'option_c' => $options[2],
                        'option_d' => $options[3],
                        'correct_option' => $correct,
                        'category' => $category,
                        'country' => $country,
                        'difficulty' => $difficulty,
                    ]);
                }
            }
        }
    }
}
