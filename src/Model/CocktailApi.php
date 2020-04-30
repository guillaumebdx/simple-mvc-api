<?php

namespace App\Model;

use App\Service\Cocktail;

class CocktailApi extends AbstractApi
{
    /**
     * @return array
     */
    public function getRandomCocktail(): array
    {
        $url      = 'https://www.thecocktaildb.com/api/json/v1/' . APP_API_KEY_COCKTAIL . '/random.php';
        $cocktail = $this->get($url);
        return Cocktail::cleanArrayOneCocktail($cocktail);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCocktailById(int $id): array
    {
        $url      = 'https://www.thecocktaildb.com/api/json/v1/' . APP_API_KEY_COCKTAIL . '/lookup.php?i=' . $id;
        $cocktail = $this->get($url);
        return Cocktail::cleanArrayOneCocktail($cocktail);
    }
}
