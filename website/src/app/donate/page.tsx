'use client';

import { useState } from 'react';

export default function Donate() {
  const [donationType, setDonationType] = useState<'one-time' | 'monthly'>('one-time');
  const [amount, setAmount] = useState<number | ''>('');
  const [customAmount, setCustomAmount] = useState<number | ''>('');

  const predefinedAmounts = [25, 50, 100, 250, 500, 1000];

  const handleAmountSelect = (selectedAmount: number) => {
    setAmount(selectedAmount);
    setCustomAmount('');
  };

  const handleCustomAmount = (value: string) => {
    const numValue = parseFloat(value);
    setCustomAmount(isNaN(numValue) ? '' : numValue);
    setAmount('');
  };

  const currentAmount = customAmount || amount;

  return (
    <div className="container mx-auto px-4 py-12">
      <div className="max-w-4xl mx-auto">
        <h1 className="text-5xl font-bold mb-8 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark bg-clip-text text-transparent text-center">
          Make a Donation
        </h1>
        
        <p className="text-xl text-center mb-16 text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
          Your donation helps us protect children across Australia. Every contribution makes a real difference in a child&apos;s life.
        </p>
        
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">
          {/* Donation Form */}
          <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
            <h2 className="text-3xl font-bold mb-6 text-primary-light dark:text-primary-dark">Choose Your Contribution</h2>
            
            {/* Donation Type */}
            <div className="mb-8">
              <div className="flex space-x-4 mb-4">
                <button
                  onClick={() => setDonationType('one-time')}
                  className={`px-6 py-3 rounded-lg font-semibold transition-all ${
                    donationType === 'one-time'
                      ? 'bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark text-white'
                      : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                  }`}
                >
                  One-time
                </button>
                <button
                  onClick={() => setDonationType('monthly')}
                  className={`px-6 py-3 rounded-lg font-semibold transition-all ${
                    donationType === 'monthly'
                      ? 'bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark text-white'
                      : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'
                  }`}
                >
                  Monthly
                </button>
              </div>
            </div>
            
            {/* Amount Selection */}
            <div className="mb-8">
              <h3 className="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Select Amount (AUD)</h3>
              <div className="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                {predefinedAmounts.map((preAmount) => (
                  <button
                    key={preAmount}
                    onClick={() => handleAmountSelect(preAmount)}
                    className={`p-4 rounded-lg border-2 font-semibold transition-all ${
                      amount === preAmount
                        ? 'border-primary-light dark:border-primary-dark bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark'
                        : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-primary-light dark:hover:border-primary-dark'
                    }`}
                  >
                    ${preAmount}
                  </button>
                ))}
              </div>
              
              <div>
                <label htmlFor="custom-amount" className="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
                  Custom Amount
                </label>
                <input
                  type="number"
                  id="custom-amount"
                  value={customAmount}
                  onChange={(e) => handleCustomAmount(e.target.value)}
                  placeholder="Enter custom amount"
                  min="1"
                  step="0.01"
                  className="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                />
              </div>
            </div>
            
            {/* Impact Message */}
            {currentAmount && (
              <div className="mb-8 p-4 bg-gradient-to-r from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 rounded-lg">
                <h4 className="font-semibold mb-2 text-primary-light dark:text-primary-dark">Your Impact:</h4>
                <p className="text-sm text-gray-600 dark:text-gray-300">
                  {currentAmount >= 1000 && "Your generous donation can fund comprehensive support services for multiple families in crisis."}
                  {currentAmount >= 500 && currentAmount < 1000 && "This donation can provide essential counseling services for children who have experienced trauma."}
                  {currentAmount >= 250 && currentAmount < 500 && "Your contribution can fund educational workshops in schools to prevent abuse."}
                  {currentAmount >= 100 && currentAmount < 250 && "This donation can provide safety resources and materials for families in need."}
                  {currentAmount >= 50 && currentAmount < 100 && "Your gift can support our community outreach and awareness programs."}
                  {currentAmount > 0 && currentAmount < 50 && "Every dollar counts and helps us continue our vital work protecting children."}
                </p>
              </div>
            )}
            
            {/* Donate Button */}
            <button
              disabled={!currentAmount}
              className="w-full px-6 py-4 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark text-white rounded-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all text-lg font-semibold disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {currentAmount 
                ? `Donate $${currentAmount} ${donationType === 'monthly' ? 'Monthly' : 'Now'}`
                : 'Select Amount to Continue'
              }
            </button>
            
            <p className="text-sm text-gray-500 dark:text-gray-400 mt-4 text-center">
              Secure donation processing. Your information is protected.
            </p>
          </div>
          
          {/* Donation Information */}
          <div className="space-y-8">
            <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
              <h2 className="text-3xl font-bold mb-6 text-primary-light dark:text-primary-dark">Why Your Donation Matters</h2>
              <div className="space-y-6">
                <div className="flex items-start space-x-4">
                  <div className="w-8 h-8 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark rounded-full flex items-center justify-center text-white font-bold">
                    1
                  </div>
                  <div>
                    <h3 className="font-semibold mb-2 text-gray-900 dark:text-white">Direct Impact</h3>
                    <p className="text-gray-600 dark:text-gray-300">100% of donations go directly to programs that protect children and support families.</p>
                  </div>
                </div>
                
                <div className="flex items-start space-x-4">
                  <div className="w-8 h-8 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark rounded-full flex items-center justify-center text-white font-bold">
                    2
                  </div>
                  <div>
                    <h3 className="font-semibold mb-2 text-gray-900 dark:text-white">Prevention Focus</h3>
                    <p className="text-gray-600 dark:text-gray-300">Your support helps prevent abuse before it happens through education and awareness.</p>
                  </div>
                </div>
                
                <div className="flex items-start space-x-4">
                  <div className="w-8 h-8 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark rounded-full flex items-center justify-center text-white font-bold">
                    3
                  </div>
                  <div>
                    <h3 className="font-semibold mb-2 text-gray-900 dark:text-white">Long-term Change</h3>
                    <p className="text-gray-600 dark:text-gray-300">We work to create systemic change that protects future generations of children.</p>
                  </div>
                </div>
              </div>
            </div>
            
            <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
              <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Other Ways to Give</h3>
              <div className="space-y-4">
                <div>
                  <h4 className="font-semibold mb-1 text-gray-900 dark:text-white">Corporate Partnerships</h4>
                  <p className="text-gray-600 dark:text-gray-300 text-sm">Partner with us to make a larger community impact.</p>
                </div>
                <div>
                  <h4 className="font-semibold mb-1 text-gray-900 dark:text-white">Workplace Giving</h4>
                  <p className="text-gray-600 dark:text-gray-300 text-sm">Set up regular donations through your employer.</p>
                </div>
                <div>
                  <h4 className="font-semibold mb-1 text-gray-900 dark:text-white">Legacy Gifts</h4>
                  <p className="text-gray-600 dark:text-gray-300 text-sm">Create lasting change with a gift in your will.</p>
                </div>
                <div>
                  <h4 className="font-semibold mb-1 text-gray-900 dark:text-white">Volunteer</h4>
                  <p className="text-gray-600 dark:text-gray-300 text-sm">Donate your time and skills to our cause.</p>
                </div>
              </div>
            </div>
            
            <div className="bg-gradient-to-r from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 p-6 rounded-2xl">
              <h3 className="text-lg font-bold mb-2">Tax Deductible</h3>
              <p className="text-sm text-gray-600 dark:text-gray-300">
                Protect Children Australia is a registered charity. All donations over $2 are tax deductible. 
                You will receive a receipt for your records.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}