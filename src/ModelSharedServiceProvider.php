<?php

declare(strict_types=1);

namespace Inisiatif\ModelShared;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Inisiatif\ModelShared\Registrars\JobModelRegistrar;
use Inisiatif\ModelShared\Registrars\BankModelRegistrar;
use Inisiatif\ModelShared\Registrars\DonorModelRegistrar;
use Inisiatif\ModelShared\Registrars\DegreeModelRegistrar;
use Inisiatif\ModelShared\Registrars\RegionModelRegistrar;
use Inisiatif\ModelShared\Registrars\AccountModelRegistrar;
use Inisiatif\ModelShared\Registrars\FundingModelRegistrar;
use Inisiatif\ModelShared\Registrars\PartnerModelRegistrar;
use Inisiatif\ModelShared\Registrars\ProgramModelRegistrar;
use Inisiatif\ModelShared\Registrars\DonationModelRegistrar;
use Inisiatif\ModelShared\Registrars\DonorPhoneModelRegistrar;
use Inisiatif\ModelShared\Registrars\FundingSourceModelRegistrar;
use Inisiatif\ModelShared\Registrars\MaritalStatusModelRegistrar;
use Inisiatif\ModelShared\Registrars\BeneficiaryTypeModelRegistrar;

final class ModelSharedServiceProvider extends PackageServiceProvider
{
    public function packageRegistered(): void
    {
        $this->registerDegreeModelRegistrar();
        $this->registerJobModelRegistrar();
        $this->registerMaritalStatusModelRegistrar();
        $this->registerRegionModelRegistrar();
        $this->registerDonationModelRegistrar();
        $this->registerFundingModelRegistrar();
        $this->registerProgramModelRegistrar();
        $this->registerPartnerModelRegistrar();
        $this->registerDonorModelRegistrar();
        $this->registerBankModelRegistrar();
        $this->registerFundingSourceModelRegistrar();
        $this->registerBeneficiaryTypeModelRegistrar();
        $this->registerAccountModelRegistrar();
    }

    public function configurePackage(Package $package): void
    {
        $package->name('model-shared')->hasConfigFile('shared');
    }

    protected function registerDegreeModelRegistrar(): void
    {
        $registrar = DegreeModelRegistrar::make(
            \config('shared.degree')
        );

        $this->app->singleton(DegreeModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations/create_degrees_tables.php');
        }
    }

    protected function registerJobModelRegistrar(): void
    {
        $registrar = JobModelRegistrar::make(
            \config('shared.job')
        );

        $this->app->singleton(JobModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations/create_jobs_tables.php');
        }
    }

    protected function registerMaritalStatusModelRegistrar(): void
    {
        $registrar = MaritalStatusModelRegistrar::make(
            \config('shared.marital_status')
        );

        $this->app->singleton(MaritalStatusModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations/create_marital_statuses_table.php');
        }
    }

    protected function registerRegionModelRegistrar(): void
    {
        $registrar = RegionModelRegistrar::make(
            \config('shared.region')
        );

        $this->app->singleton(RegionModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/000_create_countries_table.php',
                __DIR__.'/../database/migrations/001_create_provinces_table.php',
                __DIR__.'/../database/migrations/002_create_cities_table.php',
                __DIR__.'/../database/migrations/003_create_districts_table.php',
                __DIR__.'/../database/migrations/004_create_villages_table.php',
            ]);
        }
    }

    protected function registerDonationModelRegistrar(): void
    {
        $registrar = DonationModelRegistrar::make(
            \config('shared.donation')
        );

        $this->app->singleton(DonationModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/create_donations_table.php',
                __DIR__.'/../database/migrations/create_donations_table.php',
            ]);
        }
    }

    protected function registerFundingModelRegistrar(): void
    {
        $registrar = FundingModelRegistrar::make(
            \config('shared.funding')
        );

        $this->app->singleton(FundingModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/create_funding_types.php',
                __DIR__.'/../database/migrations/create_funding_categories_table.php',
            ]);
        }
    }

    protected function registerProgramModelRegistrar(): void
    {
        $registrar = ProgramModelRegistrar::make(
            \config('shared.program')
        );

        $this->app->singleton(ProgramModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/create_programs_table.php',
                __DIR__.'/../database/migrations/create_program_categories_table.php',
                __DIR__.'/../database/migrations/create_sub_program_categories_table.php',
            ]);
        }
    }

    protected function registerPartnerModelRegistrar(): void
    {
        $registrar = PartnerModelRegistrar::make(
            \config('shared.partner')
        );

        $this->app->singleton(PartnerModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/create_partners_table.php',
            ]);
        }
    }

    protected function registerDonorModelRegistrar(): void
    {
        $registrar = DonorModelRegistrar::make(
            \config('shared.donor')
        );

        $phoneModelRegistrar = DonorPhoneModelRegistrar::make(
            \config('shared.donor_phone')
        );

        $this->app->singleton(DonorPhoneModelRegistrar::class, fn () => $phoneModelRegistrar);
        $this->app->singleton(DonorModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/005_create_donors_table.php',
            ]);
        }
    }

    protected function registerBankModelRegistrar(): void
    {
        $registrar = BankModelRegistrar::make(
            \config('shared.bank')
        );

        $this->app->singleton(BankModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/006_create_banks_table.php',
            ]);
        }
    }

    protected function registerFundingSourceModelRegistrar(): void
    {
        $registrar = FundingSourceModelRegistrar::make(
            \config('shared.funding_source')
        );

        $this->app->singleton(FundingSourceModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/create_funding_sources_table.php',
            ]);
        }
    }

    protected function registerBeneficiaryTypeModelRegistrar(): void
    {
        $registrar = BeneficiaryTypeModelRegistrar::make(
            \config('shared.beneficiary_type')
        );

        $this->app->singleton(BeneficiaryTypeModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/create_beneficiary_type_table.php',
            ]);
        }
    }

    protected function registerAccountModelRegistrar(): void
    {
        $registrar = AccountModelRegistrar::make(
            \config('shared.account')
        );

        $this->app->singleton(AccountModelRegistrar::class, fn () => $registrar);

        if ($registrar->runningModelMigration()) {
            $this->loadMigrationsFrom([
                __DIR__.'/../database/migrations/create_accounts_table.php',
            ]);
        }
    }
}
