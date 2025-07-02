<?php

declare(strict_types=1);

namespace Syrniki\Telegram\KeyBoard;

use Symfony\Component\Serializer\SerializerInterface;
use Syrniki\Telegram\Interfaces\KeyboardInterface;

final class MenuKeyboard implements KeyboardInterface
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $domain;

    public function __construct(string $uri, SerializerInterface $serializer, string $domain)
    {
        $this->uri = $uri;
        $this->serializer = $serializer;
        $this->domain = $domain;
    }

    public function getKeyboard(): string
    {
        return $this->serializer->serialize(['inline_keyboard' => [
            [
                ['text' => 'Заказать', 'web_app' => ['url' => $this->domain.'/order/menu']],
            ],
            [
                ['text' => 'Доставка', 'callback_data' => 'delivery'],
                ['text' => 'Стоимость', 'callback_data' => 'price'],
                ['text' => 'Комбо', 'callback_data' => 'combo'],
            ],
            [
                ['text' => 'Пригласить друга', 'switch_inline_query' => 'Бот для заказа сырников'],
                ['text' => 'Уточнить наличие', 'url' => $this->uri],
                ['text' => 'Контакты', 'callback_data' => 'contacts'],
            ],
        ],
        ], 'json');
    }
}
