# Entity Repositories

If you want to create repositories, you have to extends ASFContactBundle repositories :

```php
// @AcmeDemoBundle/Repository/ProvinceRepository.php
namespace Acme\DemoBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use ASF\ContactBundle\Repository\ProvinceRepository as BaseRepository;

class ProvinceRepository extends BaseRepository {}
```