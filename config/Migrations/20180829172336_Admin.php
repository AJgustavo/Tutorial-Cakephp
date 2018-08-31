<?php
use Migrations\AbstractMigration;
use Cake\Auth\DefaultPasswordHasher;

class Admin extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $faker = \Faker\Factory::create();
        $populator = new Faker\ORM\CakePHP\Populator($faker);

        $populator-> addEntity('Users',1, [
            'first_name' => 'gustavo',
            'last_name' => 'edition',
            'email' => 'aj1gustavo7@gmail.com',
            'password' => function (){
                $hasher = new DefaultPasswordHasher();
                return $hasher->hash('secret');
            },
            'role' => 'admin',
            'activate' =>1,
             'create' => function () use ($faker){
                 return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
             },
             'modified' => function () use ($faker) {
                 return $faker->dateTimeBetween($startDate ='now', $endDate = 'now');
             }
        ]);

        $populator->execute(); 
    }
}
