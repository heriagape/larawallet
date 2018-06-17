<?php


namespace nattaponra\LaraWallet;


trait HasWallet
{
    public function wallet()
    {

        $wallet = $this->hasOne(Wallet::class, "user_id", "id");
        if ($wallet->count() == 0) {
            $this->initWallet($wallet);
            $wallet = $this->hasOne(Wallet::class , "user_id", "id");
        }
        return $wallet;
    }

    private function initWallet($wallet)
    {
        $wallet->create([
            'user_id' => $this->id,
            'balance' => config('larawallet.wallet_balance_init',0)
        ]);
    }
}