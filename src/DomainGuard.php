<?php

namespace Moundherb\Pavhst;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DomainGuard
{
    /**
     * The allowed domain.
     *
     * @var string
     */
    protected $allowedDomains = [
        'kkeduc.com',
        'localhost',
        '127.0.0.1'
    ];

    /**
     * The current request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Perform the domain check.
     *
     * @return void
     */
    public function check(): void
    {
        $currentDomain = $this->getCurrentDomain();
        if (!$this->isDomainAllowed($currentDomain)) {
            Log::warning('Unauthorized domain detected.', ['domain' => $currentDomain]);
            abort(403, 'Unauthorized domain.');
        }
    }

    /**
     * Determine if the current domain is allowed.
     *
     * @param string $currentDomain
     * @return bool
     */
    protected function isDomainAllowed(string $currentDomain): bool
    {
        foreach ($this->allowedDomains as $allowedDomain) {
            if ($currentDomain === $allowedDomain) {
                return true;
            }
            if (substr($currentDomain, -strlen('.' . $allowedDomain)) === '.' . $allowedDomain) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retrieve the current domain from the request.
     *
     * @return string|null
     */
    protected function getCurrentDomain(): ?string
    {
        return $this->request->getHost();
    }
}
